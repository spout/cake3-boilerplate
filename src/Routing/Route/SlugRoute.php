<?php
namespace App\Routing\Route;

use Cake\ORM\TableRegistry;
use Cake\Routing\Route\Route;

class SlugRoute extends Route
{

    function parse($url, $method = '')
    {
        $params = parent::parse($url);
        if (empty($params)) {
            return false;
        }
        $table = $this->options['table'];
        $tableInstance = TableRegistry::get($table);
        if (!empty($this->options['lang']) && $tableInstance->hasBehavior('FlatTranslate')) {
            $field = 'slug_' . $this->options['lang'];
        } else {
            $field = 'slug';
        }
        $query = $tableInstance->find('all', [
            'conditions' => [$field => $params['slug']],
        ]);
        if ($query->count()) {
            return $params;
        }
        return false;
    }

}