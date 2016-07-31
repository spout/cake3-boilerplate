<?php
$title = __("Homepage");
$this->assign('title', $title);
?>
<h1><?php echo $title; ?></h1>

<?php echo $this->element('dropzone'); ?>
<form action="/foo/bar" class="dropzone"></form>
