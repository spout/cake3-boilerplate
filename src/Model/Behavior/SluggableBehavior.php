<?php
namespace App\Model\Behavior;

use Cake\Core\Configure;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\Utility\Text;

class SluggableBehavior extends Behavior
{
    protected $_defaultConfig = [
        'field' => 'title',
        'slug' => 'slug',
        'replacement' => '-',
    ];

    public function slug(EntityInterface $entity)
    {
        $config = $this->config();
        $behaviors = $this->_table->behaviors();

        $entity->set($config['slug'], strtolower(Text::slug($entity->get($config['field']), $config['replacement'])));

        if ($behaviors->has('FlatTranslate') && in_array($config['slug'], $behaviors->get('FlatTranslate')->config()['fields'])) {
            $locales = Configure::read('Site.locales');
            foreach ($locales as $lang => $locale) {
                $entity->set(
                    sprintf('%s_%s', $config['slug'], $lang),
                    strtolower(Text::slug($entity->get(sprintf('%s_%s', $config['field'], $lang)), $config['replacement']))
                );
            }
        }
    }

    public function beforeSave(Event $event, EntityInterface $entity)
    {
        $this->slug($entity);
    }
}