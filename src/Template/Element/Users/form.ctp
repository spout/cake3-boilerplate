<?php
echo $this->Form->create($user);
echo $this->Form->inputs([
    'username' => ['label' => __("Username")],
    'email' => ['label' => __("Email")],
    'password' => ['label' => __("Password")],
    'first_name' => ['label' => __("Firstname")],
    'last_name' => ['label' => __("Lastname")],
    'active' => ['label' => __("Active")],
    'is_superuser' => ['label' => __("Superuser")],
    'role' => ['label' => __("Role"), 'options' => $roles, 'empty' => '-'],
], ['fieldset' => false]);
echo $this->Form->submit(__("Save"));
echo $this->Form->end();