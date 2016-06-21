<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class MenuItemsTable extends Table
{
    public function initialize(array $config)
    {
        $this->belongsTo('Parents', [
            'className' => 'MenuItems',
            'foreignKey' => 'parent_id',
        ]);
        $this->belongsTo('Menus');

        $this->addBehavior('FlatTranslate', [
            'fields' => ['title']
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty('title');

        return $validator;
    }

}
