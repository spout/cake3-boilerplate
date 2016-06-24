<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\I18n\I18n;
use Locale;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 * @property \Crud\Controller\Component\CrudComponent Crud
 */
abstract class AppController extends Controller
{
    use \Crud\Controller\ControllerTrait;
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('CakeDC/Users.UsersAuth');
        $this->loadComponent('Crud.Crud', [
            'actions' => [
                'Crud.Index',
                'Crud.View',
                'Crud.Add',
                'Crud.Edit',
                'Crud.Delete',
                //'Crud.Lookup',
            ],
            'listeners' => [
                'CrudView.View',
                'Crud.Redirect',
                'Crud.RelatedModels',
                //'Crud.Search',
                //'CrudView.ViewSearch',
            ]
        ]);

        //$this->loadComponent('Crud.Crud', [
        //    'actions' => [
        //        'index' => [
        //            'className' => 'Crud.Index'
        //        ],
        //        'add' => [
        //            'className' => 'Crud.Add',
        //            'messages' => [
        //                'success' => [
        //                    'params' => ['class' => 'alert alert-success alert-dismissible'],
        //                    'text' => __("Record successfully created!")
        //                ],
        //                'error' => [
        //                    'params' => ['class' => 'alert alert-danger alert-dismissible'],
        //                    'text' => __("Please correct the errors below.")
        //                ]
        //            ],
        //        ],
        //        'edit' => [
        //            'className' => 'Crud.Edit',
        //            'messages' => [
        //                'success' => [
        //                    'params' => ['class' => 'alert alert-success alert-dismissible'],
        //                    'text' => __("Record successfully modified!")
        //                ],
        //                'error' => [
        //                    'params' => ['class' => 'alert alert-danger alert-dismissible'],
        //                    'text' => __("Please correct the errors below.")
        //                ]
        //            ],
        //        ],
        //        'view' => [
        //            'className' => 'Crud.View'
        //        ],
        //        'delete' => [
        //            'className' => 'Crud.Delete',
        //            'messages' => [
        //                'success' => [
        //                    'params' => ['class' => 'alert alert-success alert-dismissible'],
        //                    'text' => __("Record successfully deleted!")
        //                ],
        //                'error' => [
        //                    'params' => ['class' => 'alert alert-danger alert-dismissible'],
        //                    'text' => __("Please correct the errors below.")
        //                ]
        //            ],
        //        ],
        //    ],
        //    'listeners' => [
        //        'CrudView.View',
        //        'Crud.Redirect',
        //        'Crud.RelatedModels',
        //        //'CrudView.Search',
        //    ]
        //]);

        $lang = $this->request->param('lang') ?: Locale::getPrimaryLanguage(I18n::defaultLocale());
        I18n::locale(Configure::read('Site.locales')[$lang]);
    }

    public function isAuthorized($user = null)
    {
        // Any registered user can access public functions
        if (empty($this->request->params['prefix'])) {
            return true;
        }

        // Only admins can access admin functions
        if ($this->request->params['prefix'] === 'admin') {
            return (bool)($user['role'] === 'admin');
        }

        // Default deny
        return false;
    }

    public function beforeFilter(Event $event)
    {
        if ($this->Auth) {
            $this->Auth->config('authorize', 'Controller');
            $this->Auth->allow(['index', 'view', 'display']);
        }

        $this->eventManager()->on('Crud.beforeHandle', function () {
            $this->Crud->action()->config('messages.success', ['params' => ['class' => 'alert alert-success alert-dismissible']]);
            $this->Crud->action()->config('messages.error', ['params' => ['class' => 'alert alert-danger alert-dismissible']]);
        });

        Configure::write('Bower.path', $this->request->webroot . 'bower_components/');
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}
