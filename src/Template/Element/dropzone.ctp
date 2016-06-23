<?php
use Cake\Core\Configure;
?>
<?php $this->append('script'); ?>
    <script src="<?= Configure::read('Bower.path'); ?>dropzone/dist/min/dropzone.min.js"></script>
<?php $this->end(); ?>
<?php $this->append('css'); ?>
    <link href="<?= Configure::read('Bower.path'); ?>dropzone/dist/min/dropzone.min.css" rel="stylesheet">
<?php $this->end(); ?>