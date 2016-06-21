<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Routing\Router;

class Content extends Entity
{
    protected function _getAbsoluteUrl()
    {
        return Router::url(['controller' => 'Contents', 'action' => 'view', $this->_properties['slug']]);
    }
}