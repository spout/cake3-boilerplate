<?php
$title = __("File manager");
$this->assign('title', $title);
?>
<h2><?php echo $title; ?></h2>
<iframe src="<?php echo $this->request->webroot; ?>elfinder/" style="width: 100%; height: 600px; border: 0;"></iframe>