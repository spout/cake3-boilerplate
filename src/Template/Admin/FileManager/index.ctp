<?php
$title = __("File manager");
$this->assign('title', $title);

$url = $this->request->webroot . 'elfinder/?' . http_build_query(['lang' => $this->request->param('lang')]);
?>
<h2><?php echo $title; ?></h2>
<iframe src="<?php echo h($url); ?>" style="width: 100%; height: 600px; border: 0;"></iframe>