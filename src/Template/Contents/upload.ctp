<?php echo $this->element('dropzone'); ?>
<?php
echo $this->Form->create(null, ['type' => 'file', 'class' => 'dropzone']);
echo $this->Form->input('file', ['type' => 'file']);
echo $this->Form->submit();
echo $this->Form->end();