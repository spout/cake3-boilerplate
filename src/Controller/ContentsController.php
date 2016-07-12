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
        //$this->Contents->recover();
        $content = $this->Contents->find('language', ['path' => $path])->firstOrFail();
        $this->Contents->incrementCounter($content->id);
        $this->set(compact('content'));
    }
}