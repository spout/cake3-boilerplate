<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

class SitemapController extends AppController
{
    public function index()
    {
        $this->viewBuilder()->layout(false);

        Configure::load('sitemap', 'yaml');
        $sitemapTables = Configure::read('Sitemap.tables');

        $urls = [];
        foreach ($sitemapTables as $table) {
            $tableInstance = TableRegistry::get($table);
            $rows = $tableInstance->find('all');
            $urls[$table] = $rows;
        }

        $this->set(compact('urls'));
    }
}