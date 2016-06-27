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
        //$this->Contents->recover();
        //$descendants = $this->Contents->find('children', ['for' => 1]);
        //foreach ($descendants as $descendant) {
        //    echo $descendant->title . "\n";
        //}
        $this->set('content', $this->Contents->find('language', ['slug' => $slug])->first());
    }
}