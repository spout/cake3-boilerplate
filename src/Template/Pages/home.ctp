<?php
$title = __("Homepage");
$this->assign('title', $title);
?>
<h1><?php echo $title; ?></h1>

<?php
pr(\Cake\Core\Configure::read('Site'));
//echo $this->cell('Menu', ['principal']);

$locales = \Cake\Core\Configure::read('Site.locales');
?>
<?php if(!empty($locales)): ?>
    <ul>
        <?php foreach($locales as $lang => $locale): ?>
            <li><?php echo $this->Html->link(\Locale::getDisplayLanguage($locale, $locale), ['lang' => $lang, 'controller' => 'Pages', 'action' => 'display', 'home']); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php echo $this->element('dropzone'); ?>
<form action="/foo/bar" class="dropzone"></form>
