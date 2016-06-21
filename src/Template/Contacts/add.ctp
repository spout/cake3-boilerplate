<?php
$this->assign('title', __("Contact us"));

echo $this->Form->create($contact, ['novalidate']);
echo $this->Form->input('email', ['label' => __("Your email")]);
echo $this->Form->input('subject', ['label' => __("Subject"), 'default' => $this->request->query('subject')]);
echo $this->Form->input('message', ['label' => __("Message")]);
echo $this->Form->submit(__("Send"), ['class' => 'btn btn-primary']);
echo $this->Form->hidden('redirect_url', ['value' => \Cake\Routing\Router::url(['controller' => 'Contacts', 'action' => 'add'])]);
echo $this->Form->end();