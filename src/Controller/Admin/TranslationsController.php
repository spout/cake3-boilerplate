<?php
namespace App\Controller\Admin;

use Cake\Filesystem\Folder;
use Sepia\FileHandler;
use Sepia\PoParser;

class TranslationsController extends AdminController
{
    public function index($file = null)
    {
        $folder = new Folder(APP . 'Locale');
        $files = $folder->findRecursive('.*\.po');

        if (!empty($file)) {
            $fileHandler = new FileHandler('/var/www/dev.spout.be/src/Locale/fr/default.po');
            $poParser = new PoParser($fileHandler);
            $entries  = $poParser->parse();
            $this->set('entries', $entries);
        }

        $this->set(compact('file', 'files'));
    }
}