<?php
namespace App\Controller;

class CategoriesController extends AppController
{
    public function index()
    {
        $this->autoRender = false;
        //debug($this->Categories->find('children', ['path' => '/1'])->nest());
    }
}