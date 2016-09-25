<?php
echo $this->Form->create($contact);
echo $this->Form->inputs([
    'email' => ['label' => __("Email")],
    'subject' => ['label' => __("Subject")],
    'message' => ['label' => __("Subject")],
], ['fieldset' => false]);
echo $this->Form->submit(__("Save"));
echo $this->Form->end();