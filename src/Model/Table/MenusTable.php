<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class MenusTable extends Table
{
    public function initialize(array $config)
    {
        $this->hasMany('MenuItems');

        $this->addBehavior('FlatTranslate', [
            'fields' => [
                'title',
            ]
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty('title');

        return $validator;
    }

}
