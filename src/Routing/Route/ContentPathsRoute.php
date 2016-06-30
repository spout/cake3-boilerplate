<?php
namespace App\Routing\Route;

use Cake\ORM\TableRegistry;
use Cake\Routing\Route\Route;

class ContentPathsRoute extends Route
{

    function parse($url)
    {
        $params = parent::parse($url);
        if (empty($params)) {
            return false;
        }
        $tableInstance = TableRegistry::get('ContentPaths');
        $field = 'path_' . $this->options['lang'];
        $query = $tableInstance->find('all', [
            'conditions' => [$field => $params['path']],
        ]);
        if ($query->count()) {
            return $params;
        }
        return false;
    }

}