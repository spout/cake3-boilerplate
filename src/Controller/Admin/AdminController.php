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

        $scaffolds = require APP . 'config' . DS . 'scaffolds.php';
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
                    $config = Hash::get($scaffolds, sprintf('%s.%s.%s', $this->request->param('controller'), $configKey, $this->request->param('action')));
                    break;

                default:
                    $config = Hash::get($scaffolds, sprintf('%s.%s', $this->request->param('controller'), $configKey));
                    break;
            }

            if (!empty($config)) {
                $action->config(sprintf('scaffold.%s', $configKey), $config);
            }
        }

        /**
         * Per action fields
         */
        $perActionFields = Hash::get($scaffolds, sprintf('%s.per_action_fields.%s', $this->request->param('controller'), $this->request->param('action')));
        $fields = Hash::get($scaffolds, sprintf('%s.fields', $this->request->param('controller')));
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