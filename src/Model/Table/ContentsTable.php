<?php
namespace App\Model\Table;

use Cake\ORM\Table;

/**
 * Class ContentsTable
 * @package App\Model\Table
 */
class ContentsTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        $this->addBehavior('Sluggable');
        $this->addBehavior('FlatTranslate', [
            'fields' => [
                'path',
                'slug',
                'title',
                'content',
                'meta_description',
            ]
        ]);
    }

    //public function validationDefault(Validator $validator)
    //{
    //
    //}

}