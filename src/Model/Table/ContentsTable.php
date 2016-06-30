<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Class ContentsTable
 * @package App\Model\Table
 */
class ContentsTable extends Table
{
    public function initialize(array $config)
    {
        $this->hasMany('ContentPaths');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Sluggable');
        $this->addBehavior('FlatTranslate', [
            'fields' => [
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