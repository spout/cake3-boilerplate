<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class MenusItemsTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('FlatTranslate', [
            'fields' => ['title']
        ]);

        $this->belongsTo('Parents', [
            'className' => 'MenuItems',
            'foreignKey' => 'parent_id',
        ]);

        $this->belongsTo('Menus', [
            'className' => 'Menus',
            'foreignKey' => 'menu_id',
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty('title');

        return $validator;
    }

}
