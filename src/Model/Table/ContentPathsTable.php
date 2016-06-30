<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Class ContentsTable
 * @package App\Model\Table
 */
class ContentPathsTable extends Table
{
    public function initialize(array $config)
    {
        $this->belongsTo('Contents');
        //$this->hasOne('Parent', [
        //    'className' => 'Content',
        //    'foreignKey' => 'content_parent_id',
        //]);

        $this->addBehavior('FlatTranslate', [
            'fields' => [
                'path',
            ]
        ]);
    }
}