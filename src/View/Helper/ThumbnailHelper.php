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
        'absoluteDir' => WWW_ROOT,
        'cacheDir' => 'img/thumbs/',
    ];

    private $filename;
    private $extension;
    private $cacheDir;
    private $absoluteCacheDir;
    private $cacheFilename;
    private $cacheFilenameUrl;
    private $absoluteCacheFilename;
    private $size;
    private $mode;
    private $filter;
    private $saveOptions;

    private function setup($filename, $params)
    {
        $defaultParams = [
            'size' => [100, 100],
            'mode' => ManipulatorInterface::THUMBNAIL_INSET,
            'filter' => ImageInterface::FILTER_UNDEFINED,
            'saveOptions' => []
        ];
        $params = array_merge($defaultParams, $params);

        list($width, $height) = is_array($params['size']) ? [$params['size'][0], $params['size'][1]] : explode('x', $params['size']);

        $this->filename = $filename;
        $this->extension = pathinfo($filename, PATHINFO_EXTENSION);
        $this->cacheDir = $this->config('cacheDir');
        $this->absoluteCacheDir = $this->config('absoluteDir') . $this->cacheDir;
        $this->cacheFilename = sprintf('%s.%s', md5(json_encode(array_merge([$filename], $params))), $this->extension);
        $this->cacheFilenameUrl = sprintf('/%s%s', $this->cacheDir, $this->cacheFilename);
        $this->absoluteCacheFilename = $this->absoluteCacheDir . $this->cacheFilename;
        $this->size = new Imagine\Image\Box($width, $height);
        $this->mode = $params['mode'];
        $this->filter = $params['filter'];
        $this->saveOptions = $params['saveOptions'];
    }

    private function isCachedThumbnail()
    {
        return file_exists($this->absoluteCacheFilename) && filemtime($this->absoluteCacheFilename) > filemtime($this->filename);
    }

    private function createThumbnail()
    {
        $class = sprintf('Imagine\%s\Imagine', $this->config('interface'));
        /** @var $imagine Imagine\Image\AbstractImagine */
        $imagine = new $class();
        $imagine
            ->open($this->filename)
            ->thumbnail($this->size, $this->mode, $this->filter)
            ->save($this->absoluteCacheFilename, $this->saveOptions);
    }

    public function url($filename, $params = [])
    {
        $this->setup($filename, $params);

        if (!$this->isCachedThumbnail()) {
            $this->createThumbnail();
        }

        return $this->cacheFilenameUrl;
    }
}