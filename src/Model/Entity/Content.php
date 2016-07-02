<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Content extends Entity
{
    protected function _getAbsoluteUrl()
    {
        return ['controller' => 'Contents', 'action' => 'view', $this->_properties['path']];
    }
}