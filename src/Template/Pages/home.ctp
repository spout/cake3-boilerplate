<?php
$title = __("Homepage");
$this->assign('title', $title);
?>
<h1><?php echo $title; ?></h1>

<?php
pr(\Cake\Core\Configure::read('Site'));
//echo $this->cell('Menu', ['principal']);
?>