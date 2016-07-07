<?php
$title = __("File manager");
$this->assign('title', $title);

$url = $this->request->webroot . 'elfinder/?' . http_build_query(['lang' => $this->request->param('lang')]);
?>
<h2><?php echo $title; ?></h2>
<iframe src="<?php echo h($url); ?>" class="elfinder"></iframe>