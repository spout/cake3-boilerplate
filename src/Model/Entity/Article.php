<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Article extends Entity
{
    protected function _getAbsoluteUrl()
    {
        return ['controller' => 'Articles', 'action' => 'view', $this->_properties['slug']];
    }
}