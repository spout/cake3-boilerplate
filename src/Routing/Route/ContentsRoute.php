<?php
namespace App\Routing\Route;

use Cake\ORM\TableRegistry;
use Cake\Routing\Route\Route;

class ContentsRoute extends Route
{

    function parse($url)
    {
        $params = parent::parse($url);
        if (empty($params)) {
            return false;
        }
        $tableInstance = TableRegistry::get('Contents');
        $query = $tableInstance->find('language', ['path' => $params['path']]);
        if ($query->first()) {
            return $params;
        }
        return false;
    }

}