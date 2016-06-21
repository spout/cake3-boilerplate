<?php
namespace App\Controller;

/**
 * Class ContentsController
 * @package App\Controller
 * @property $Contents App\Model\Table\ContentsTable
 */
class ContentsController extends AppController
{
    public function view($slug)
    {
        $this->set('content', $this->Contents->find('locale', ['slug' => $slug])->first());
    }
}