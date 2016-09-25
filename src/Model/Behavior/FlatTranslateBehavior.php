<?php
namespace App\Model\Behavior;

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\Behavior;
use Cake\Event\Event;
use Cake\I18n\I18n;
use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Datasource\EntityInterface;
use Migrations\AbstractMigration;
use Locale;

class FlatTranslateBehavior extends Behavior
{
    protected $_language;

    protected $_defaultConfig = [
        'implementedFinders' => ['language' => 'findLanguage'],
        'implementedMethods' => ['language' => 'language'],
        'fields' => [],
        'defaultLanguage' => '',
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
            'defaultLanguage' => Locale::getPrimaryLanguage(I18n::defaultLocale()),
        ];

        parent::__construct($table, $config);
    }

    public function initialize(array $config)
    {
        $this->_addTranslateColumns();
    }

    public function language($language = null)
    {
        if ($language === null) {
            return $this->_language ?: Locale::getPrimaryLanguage(I18n::locale());
        }
        return $this->_language = $language;
    }

    public function getPrimaryLanguage($locale = null)
    {
        if ($locale === null) {
            $locale = I18n::locale();
        }
        return Locale::getPrimaryLanguage($locale);
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
            foreach (Configure::read('Site.locales') as $lang => $locale) {
                $fieldTranslate = sprintf('%s_%s', $field, $lang);
                if (!in_array($fieldTranslate, $columns)) {
                    $column = $table->schema()->column($field);
                    $options = [
                        'length' => $column['length'],
                        'default' => $column['default'],
                        'null' => $column['null'],
                        'comment' => $column['comment'],
                        'after' => $field,
                    ];
                    $migrationTable->addColumn($fieldTranslate, $column['type'], $options)->update();
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
        $defaultLanguage = $this->config('defaultLanguage');

        foreach ($this->config('fields') as $field) {
            $entity->set($field, $entity->get(sprintf('%s_%s', $field, $defaultLanguage)));
        }
    }

    public function beforeFind(Event $event, Query $query, $options)
    {
        $language = $this->getPrimaryLanguage();
        $defaultLanguage = $this->config('defaultLanguage');

        if ($language === $defaultLanguage) {
            return;
        }

        $query->formatResults(function ($results) use ($language) {
            return $results->map(function ($row) use ($language) {
                foreach ($this->config('fields') as $field) {
                    $key = sprintf('%s_%s', $field, $language);
                    if (!empty($row[$key])) {
                        $row[$field] = $row[$key];
                    }
                }
                return $row;
            });
        });
    }

    public function findLanguage(Query $query, array $options)
    {
        list($field, $value) = each($options);
        return $query->where([sprintf('%s_%s', $field, $this->language()) => $value]);
    }

}