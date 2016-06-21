<?php
namespace App\Model\Behavior;

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\Behavior;
use Cake\Event\Event;
use Cake\I18n\I18n;
use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Datasource\ResultSetInterface;
use Cake\Datasource\EntityInterface;
use Migrations\AbstractMigration;

class FlatTranslateBehavior extends Behavior
{
    protected $_locale;

    protected $_defaultConfig = [
        'implementedFinders' => ['locale' => 'findLocale'],
        'implementedMethods' => ['locale' => 'locale'],
        'fields' => [],
        'defaultLocale' => '',
        'migrationAdapters' => [
            /**
             * Mapping Cake\Database\Driver to Phinx\Db\Adapter
             */
            'Mysql' => 'Mysql',
            'Postgres' => 'Postgres',
            'Sqlite' => 'SQLite',
            'Sqlserver' => 'SqlServer'
        ],
    ];

    public function __construct(Table $table, array $config = [])
    {
        $config += [
            'defaultLocale' => I18n::defaultLocale(),
        ];

        parent::__construct($table, $config);
    }

    public function initialize(array $config)
    {
        $this->_addTranslateColumns();
    }

    public function locale($locale = null)
    {
        if ($locale === null) {
            return $this->_locale ?: I18n::locale();
        }
        return $this->_locale = (string)$locale;
    }

    protected function _addTranslateColumns()
    {
        $table = $this->_table;
        $connConfig = $table->connection()->config();
        $connConfig['pass'] = $connConfig['password'];
        $connConfig['user'] = $connConfig['username'];
        $connConfig['name'] = $connConfig['database'];

        $driverParts = explode('\\', $connConfig['driver']);
        $driver = end($driverParts);

        $migrationAdapterClass = sprintf('Phinx\Db\Adapter\%sAdapter', $this->config('migrationAdapters')[$driver]);
        $migrationObject = new AbstractMigration(mt_rand());
        $migrationObject->setAdapter(new $migrationAdapterClass($connConfig));
        $migrationTable = $migrationObject->table($table->table());

        $columns = $table->schema()->columns();
        $addedColumn = false;
        foreach ($this->config('fields') as $field) {
            foreach (Configure::read('Site.languages') as $lang) {
                $fieldTranslate = sprintf('%s_%s', $field, $lang);
                if (!in_array($fieldTranslate, $columns)) {
                    $type = $table->schema()->columnType($field);
                    $migrationTable->addColumn($fieldTranslate, $type, ['after' => $field])->update();
                    $addedColumn = true;
                }
            }
        }

        if ($addedColumn) {
            Cache::clearAll();
        }
    }

    public function beforeSave(Event $event, EntityInterface $entity)
    {
        $locale = $this->locale();
        $defaultLocale = $this->config('defaultLocale');

        foreach ($this->config('fields') as $field) {
            $entity->set(sprintf('%s_%s', $field, $locale), $entity->get($field));
            $entity->set($field, $entity->get(sprintf('%s_%s', $field, $defaultLocale)));
        }
    }

    public function beforeFind(Event $event, Query $query, $options)
    {
        $locale = $this->locale();
        $defaultLocale = $this->config('defaultLocale');

        if ($locale === $defaultLocale) {
            return;
        }

        $query->formatResults(function (ResultSetInterface $results) use ($locale) {
            return $results->map(function ($row) use ($locale) {
                foreach ($this->config('fields') as $field) {
                    $row[$field] = $row[sprintf('%s_%s', $field, $locale)];
                }
                return $row;
            });
        });
    }

    public function findLocale(Query $query, array $options)
    {
        list($field, $value) = each($options);
        return $query->where([sprintf('%s_%s', $field, $this->locale()) => $value]);
    }

}