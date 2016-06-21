<?php
namespace App\View\Cell;

use Cake\View\Cell;

class MenusCell extends Cell
{
    public function display()
    {
        $this->loadModel('Menus');
        $menus = $this->Menus->find();
        $this->set(compact('menus'));
    }
}