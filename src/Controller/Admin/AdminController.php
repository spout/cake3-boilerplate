<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Utility\Hash;

abstract class AdminController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $action = $this->Crud->action();
        $action->config('scaffold.disable_sidebar', true);

        $configs = [
            'Contacts' => [
                'fields' => [
                    'email' => [
                        'title' => __("Email"),
                        'label' => __("Email"),
                    ],
                    'subject' => [
                        'title' => __("Subject"),
                        'label' => __("Subject")
                    ],
                    'message' => [
                        'title' => __("Message"),
                        'label' => __("Message")
                    ],
                ],
                'page_title' => [
                    'index' => __("Contacts")
                ],
            ],
            'Contents' => [
                'fields' => [
                    'title' => [
                        'title' => __("Title"),
                        'label' => __("Title")
                    ],
                    'slug' => [
                        'title' => __("Slug"),
                        'label' => __("Slug")
                    ],
                    'content' => [
                        'title' => __("Content"),
                        'label' => __("Content")
                    ],
                ],
                'page_title' => [
                    'index' => __("Contents"),
                    //'view' => __("Content"),
                    'add' => __("Add content"),
                    'edit' => __("Edit content"),
                ],
            ],
            'Menus' => [
                'fields' => [
                    'title' => [
                        'title' => __("Title"),
                        'label' => __("Title")
                    ],
                    'identifier' => [
                        'title' => __("Identifier"),
                        'label' => __("Identifier"),
                    ],
                ],
                'page_title' => [
                    'index' => __("Menus")
                ],
            ],
            'Users' => [
                'fields' => [
                    'username' => [
                        'title' => __("Username"),
                        'label' => __("Username"),
                    ],
                    'email' => [
                        'title' => __("Email"),
                        'label' => __("Email"),
                    ],
                    'first_name' => [
                        'title' => __("Firstname"),
                        'label' => __("Firstname"),
                    ],
                    'last_name' => [
                        'title' => __("Lastname"),
                        'label' => __("Lastname"),
                    ],
                    'active' => [
                        'title' => __("Active"),
                        'label' => __("Active"),
                    ],
                    'role' => [
                        'title' => __("Role"),
                        'label' => __("Role"),
                    ],
                    'is_superuser' => [
                        'title' => __("Superuser"),
                        'label' => __("Superuser"),
                    ],
                ],
                'page_title' => [],
            ],
        ];

        $configKeys = [
            'action_groups',
            'actions',
            'autoFields',
            'brand',
            'bulk_actions',
            'disable_extra_buttons',
            'disable_sidebar',
            'enable_dirty_check',
            'extra_buttons_blacklist',
            'field_settings',
            'fields',
            'fields_blacklist',
            'form_action',
            'page_title',
            'relations',
            'relations_blacklist',
            'tables',
            'tables_blacklist',
            'viewblocks',
        ];

        foreach ($configKeys as $configKey) {
            switch ($configKey) {
                case 'page_title':
                    $config = Hash::get($configs, sprintf('%s.%s.%s', $this->request->param('controller'), $this->request->param('action'), $configKey));
                    break;

                default:
                    $config = Hash::get($configs, sprintf('%s.%s', $this->request->param('controller'), $configKey));
                    break;
            }

            if (!empty($config)) {
                $action->config(sprintf('scaffold.%s', $configKey), $config);
            }
        }
    }

    public function beforeRender(Event $event)
    {
        if ($this->viewBuilder()->className() === null) {
            $this->viewBuilder()->className('CrudView\View\CrudView');
        }
        $this->viewBuilder()->layout($this->request->is('ajax') ? 'ajax' : 'admin');
    }
}