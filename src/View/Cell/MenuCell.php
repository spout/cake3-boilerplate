<?php
namespace App\View\Cell;

use Cake\I18n\I18n;
use Cake\ORM\TableRegistry;
use Cake\View\Cell;
use Symfony\Component\Yaml\Yaml;

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

        /**
         * For "/" URL without lang, params['lang'] isn't set and cause errors
         */
        if (empty($this->request->params['lang'])) {
            $this->request->params['lang'] = I18n::defaultLocale();
        }

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