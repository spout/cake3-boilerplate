<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;

/**
 * Class ContentsController
 * @package App\Controller
 * @property $Contents App\Model\Table\ContentsTable
 */
class ContentsController extends AppController
{
    public function view($path)
    {
        $contentPathsTable = TableRegistry::get('ContentPaths');
        $contentPath = $contentPathsTable
            ->find('language', ['path' => $path])
            ->contain(['Contents'])
            ->firstOrFail();

        $this->set(compact('contentPath'));
    }
}