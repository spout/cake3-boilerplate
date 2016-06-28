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
                    'parent_id' => [
                        'title' => __("Parent"),
                        'label' => __("Parent")
                    ],
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
                    'meta_description' => [
                        'title' => __("Meta description"),
                        'label' => __("Meta description")
                    ],
                ],
                'fields_actions' => [
                    'index' => ['title', 'slug'],
                    'view' => ['parent_id', 'title', 'slug', 'content', 'meta_description'],
                    'add' => ['parent_id', 'title', 'slug', 'content', 'meta_description'],
                    'edit' => ['parent_id', 'title', 'slug', 'content', 'meta_description'],
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
                    'slug' => [
                        'title' => __("Slug"),
                        'label' => __("Slug"),
                    ],
                    'attributes' => [
                        'title' => __("Attributes"),
                        'label' => __("Attributes"),
                    ],
                ],
                'relations' => [
                    'MenuItems'
                ],
                'page_title' => [
                    'index' => __("Menus")
                ],
            ],
            'MenuItems' => [
                'fields' => [
                    'parent_id' => [
                        'title' => __("Parent"),
                        'label' => __("Parent")
                    ],
                    'menu_id' => [
                        'title' => __("Menu"),
                        'label' => __("Menu"),
                    ],
                    'model' => [
                        'title' => __("Model"),
                        'label' => __("Model"),
                    ],
                    'foreign_key' => [
                        'title' => __("Foreign key"),
                        'label' => __("Foreign key"),
                    ],
                    'title' => [
                        'title' => __("Title"),
                        'label' => __("Title"),
                    ],
                    'url' => [
                        'title' => __("URL"),
                        'label' => __("URL"),
                    ],
                    'attributes' => [
                        'title' => __("Attributes"),
                        'label' => __("Attributes"),
                    ],
                ],
                'page_title' => [
                    'index' => __("Menus")
                ],
            ],
            'Users' => [
                'fields' => [
                    'active' => [
                        'title' => __("Active"),
                        'label' => __("Active"),
                    ],
                    'is_superuser' => [
                        'title' => __("Superuser"),
                        'label' => __("Superuser"),
                    ],
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
                    'role' => [
                        'title' => __("Role"),
                        'label' => __("Role"),
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

        /**
         * Per action fields
         */
        $perActionFields = Hash::get($configs, sprintf('%s.fields_actions.%s', $this->request->param('controller'), $this->request->param('action')));
        $fields = Hash::get($configs, sprintf('%s.fields', $this->request->param('controller')));
        if (!empty($perActionFields)) {
            $scaffoldFields = [];
            foreach ($fields as $field => $options) {
                if (in_array($field, $perActionFields)) {
                    $scaffoldFields[$field] = $options;
                }
            }
            $action->config('scaffold.fields', $scaffoldFields, $merge = false);
        }
    }

    public function beforeRender(Event $event)
    {
        $this->viewBuilder()->className('CrudView\View\CrudView');
        $this->viewBuilder()->layout($this->request->is('ajax') ? 'ajax' : 'admin');
    }
}