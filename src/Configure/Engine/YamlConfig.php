<?php
namespace App\Configure\Engine;

use Cake\Core\Configure\ConfigEngineInterface;
use Cake\Core\Configure\FileConfigTrait;
use Cake\Core\Exception\Exception;
use Symfony\Component\Yaml\Exception\DumpException;
use Symfony\Component\Yaml\Yaml;

class YamlConfig implements ConfigEngineInterface
{

    use FileConfigTrait;

    protected $_extension = '.yml';

    /**
     * YamlConfig constructor.
     * @param null $path
     */
    public function __construct($path = null)
    {
        if ($path === null) {
            $path = CONFIG;
        }
        $this->_path = $path;
    }

    /**
     * @param string $key Key
     * @return array
     */
    public function read($key)
    {
        $file = $this->_getFilePath($key, true);
        $input = file_get_contents($file);
        $config = Yaml::parse($input);
        if (is_array($config)) {
            return $config;
        } else {
            throw new Exception(sprintf('Config file "%s" did not return an array', $key . '.php'));
        }
    }

    /**
     * @param string $key
     * @param array $data
     * @return bool
     */
    public function dump($key, array $data)
    {
        try {
            $yaml = Yaml::dump($data);
        } catch (DumpException $e) {
            return false;
        }

        $file = $this->_getFilePath($key, true);
        $bytes = file_put_contents($file, $yaml);
        return $bytes === false ? false : true;
    }
}