<?php
namespace App\Controller\Admin;

class ConfigsController extends AdminController
{
    public function index($file = null)
    {
        $files = glob(CONFIG . '*.{yml,ini}', GLOB_BRACE);

        if (!empty($file)) {
            if ($this->request->is('post')) {
                if (file_put_contents(CONFIG . $file, $this->request->data('content')) !== false) {
                    $this->Flash->success(__("File was saved successfully !"));
                } else {
                    $this->Flash->error(__("An error occured while saving file."));
                }
            } else {
                $this->request->data('content', file_get_contents(CONFIG . $file));
            }
        }

        $this->set(compact('file', 'files'));
    }

}