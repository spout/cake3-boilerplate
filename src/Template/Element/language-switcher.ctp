<?php
$locales = \Cake\Core\Configure::read('Site.locales');
?>
<?php if(!empty($locales)): ?>
    <ul class="list-inline">
        <?php foreach($locales as $lang => $locale): ?>
            <li><?php echo $this->Html->link(ucfirst(\Locale::getDisplayLanguage($locale, $locale)), ['lang' => $lang, 'controller' => 'Pages', 'action' => 'display', 'home']); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>