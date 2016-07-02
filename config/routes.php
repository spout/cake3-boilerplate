<?php
use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Core\Configure;
use Cake\Routing\Route\DashedRoute;

Router::defaultRouteClass(DashedRoute::class);
Router::extensions(['json']);

Router::addUrlFilter(function ($params, $request) {
    /* @var $request \Cake\Network\Request */
    if (isset($request->params['lang']) && !isset($params['lang'])) {
        $params['lang'] = $request->params['lang'];
    }
    return $params;
});

Router::scope('/', function (RouteBuilder $routes) {
    foreach (Configure::read('Site.locales') as $lang => $locale) {
        $routes->scope('/' . $lang, ['lang' => $lang], function ($routes) use ($lang) {
            /* @var $routes \Cake\Routing\RouteBuilder */
            $routes->prefix('admin', function ($routes) {
                /* @var $routes \Cake\Routing\RouteBuilder */
                $routes->connect('/', ['controller' => 'Dashboard']);
                $routes->fallbacks('DashedRoute');
            });
            $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
            $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);
            $routes->connect(
                '/:path',
                ['controller' => 'Contents', 'action' => 'view'],
                ['_name' => 'contentsView', 'routeClass' => 'ContentsRoute', 'lang' => $lang, 'pass' => ['path'], 'path' => '[-/\w\d]+']
            );
            $routes->connect('/contact', ['controller' => 'Contacts', 'action' => 'add']);
            $routes->fallbacks('DashedRoute');
        });
    }
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
});

Plugin::routes();
