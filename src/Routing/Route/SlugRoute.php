<?php
namespace App\Routing\Route;

use Cake\ORM\TableRegistry;
use Cake\Routing\Route\Route;

class SlugRoute extends Route
{

    function parse($url)
    {
        $params = parent::parse($url);
        if (empty($params)) {
            return false;
        }
        $table = $this->options['table'];
        $tableInstance = TableRegistry::get($table);
        $field = $tableInstance->hasBehavior('FlatTranslate') ? 'slug_' . $tableInstance->language() : 'slug';
        $query = $tableInstance->find('all', [
            'conditions' => [$field => $params['slug']],
        ]);
        if ($query->count()) {
            return $params;
        }
        return false;
    }

}