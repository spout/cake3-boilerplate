<?php
namespace App\View\Cell;

use Cake\ORM\TableRegistry;
use Cake\View\Cell;

/**
 * Class MenusCell
 * @package App\View\Cell
 * @property $Menus App\Model\Table\MenusTable
 */
class MenuCell extends Cell
{
    public function display($slug)
    {
        $this->loadModel('Menus');
        $menu = $this->Menus->find()->contain(['MenuItems'])->where(compact('slug'))->first();

        foreach ($menu->menu_items ?:[] as &$item) {
            if (!empty($item->model) && !empty($item->foreign_key)) {
                $table = TableRegistry::get($item->model);
                $entity = $table->get($item->foreign_key);
                $item->url = $entity->absoluteUrl;
                $item->title = $entity->{$table->displayField()};
            }
        }

        $this->set(compact('menu'));
    }
}