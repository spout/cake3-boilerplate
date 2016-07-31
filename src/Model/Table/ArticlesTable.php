<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class ArticlesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        $this->addBehavior('Sluggable');
        $this->addBehavior('FlatTranslate', [
            'fields' => [
                'title',
                'slug',
                'body',
            ]
        ]);
    }
}