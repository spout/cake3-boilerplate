<?php
use Cake\Core\Configure;

$locales = Configure::read('Site.locales');
$idFormat = isset($idFormat) ? $idFormat : 'lang-%s';
?>
<ul class="nav nav-tabs" role="tablist">
    <?php foreach($locales as $lang => $locale): ?>
        <li role="presentation"<?php echo $lang == $this->request->params['lang'] ? ' class="active"' : ''; ?>>
            <a href="#<?php echo sprintf($idFormat, $lang); ?>" role="tab" data-toggle="tab"><?php echo ucfirst(\Locale::getDisplayLanguage($locale, $locale)); ?></a>
        </li>
    <?php endforeach; ?>
</ul>