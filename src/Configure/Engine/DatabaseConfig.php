<?php
namespace App\Configure\Engine;

use Cake\Cache\Cache;
use Cake\Core\Configure\ConfigEngineInterface;
use Cake\ORM\TableRegistry;

class DatabaseConfig implements ConfigEngineInterface
{
    /**
     * @param string $key Key
     * @return array
     */
    public function read($key)
    {
        $cacheKey = sprintf('DatabaseConfig%s', $key);
        if (($configs = Cache::read($cacheKey)) === false) {
            $configsTable = TableRegistry::get($key);
            $configs = $configsTable->find('list', [
                'keyField' => 'name',
                'valueField' => 'value'
            ])->toArray();

            $configs = array_map(function($value) {
                return json_decode($value, true);
            }, $configs);

            Cache::write($cacheKey, $configs);
        }
        return $configs;
    }

    /**
     * @param string $key
     * @param array $data
     * @return bool
     */
    public function dump($key, array $data)
    {
        return false;
    }
}