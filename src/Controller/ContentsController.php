<?php
namespace App\Controller;

/**
 * Class ContentsController
 * @package App\Controller
 * @property $Contents App\Model\Table\ContentsTable
 */
class ContentsController extends AppController
{
    public function view($path)
    {
        $content = $this->Contents->find('language', ['path' => $path])->firstOrFail();
        $this->set(compact('content'));
    }
}