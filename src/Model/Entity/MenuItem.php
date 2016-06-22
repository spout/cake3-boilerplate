<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Symfony\Component\Yaml\Yaml;

class MenuItem extends Entity
{
    protected function _getAttributes()
    {
        return !empty($this->_properties['attributes']) ? Yaml::parse($this->_properties['attributes']) : [];
    }
}