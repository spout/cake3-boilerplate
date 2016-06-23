<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Imagine;
use Imagine\Image\ManipulatorInterface;
use Imagine\Image\ImageInterface;

class ThumbnailHelper extends Helper
{
    protected $_defaultConfig = [
        'interface' => 'Gd', // Gd, Imagick, Gmagick
        'savePath' => ''
    ];

    /**
     * @var Imagine\Image\AbstractImagine $_imagine
     */
    protected $_imagine;

    public function initialize(array $config)
    {
        $class = sprintf('Imagine\%s\Imagine', $this->config('interface'));
        $this->_imagine = new $class();
    }

    public function url($path, $params = [])
    {
        $defaultParams = [
            'size' => [100, 100],
            'mode' => ManipulatorInterface::THUMBNAIL_INSET,
            'filter' => ImageInterface::FILTER_UNDEFINED,
        ];
        $params = array_merge($defaultParams, $params);

        list($width, $height) = is_array($params['size']) ? each($params['size']) : explode('x', $params['size']);
        $size = new Imagine\Image\Box($width, $height);

        $savePath = '';

        $this->_imagine
            ->load($path)
            ->thumbnail($size, $params['mode'], $params['filter'])
            ->save($savePath);
    }
}