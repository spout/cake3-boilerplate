<?php
use Cake\Core\Configure;

$locales = Configure::read('Site.locales');
$idFormat = 'lang-%s';
?>
<?php echo $this->Form->create($content); ?>
    <?php echo $this->element('form-locales-tabs'); ?>
    <div class="tab-content">
        <?php foreach($locales as $lang => $locale): ?>
            <div role="tabpanel" class="tab-pane<?php echo $lang == $this->request->params['lang'] ? ' active' : ''; ?>" id="<?php echo sprintf($idFormat, $lang); ?>">
                <?php
                echo $this->Form->inputs([
                    sprintf('title_%s', $lang) => ['label' => __("Title")],
                    sprintf('slug_%s', $lang) => ['label' => __("Slug")],
                    sprintf('content_%s', $lang) => ['label' => __("Content"), 'class' => 'wysiwyg'],
                    sprintf('meta_description_%s', $lang) => ['label' => __("Meta description")],
                ], ['fieldset' => false]);
                ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?php echo $this->Form->submit(__("Save")); ?>
<?php echo $this->Form->end(); ?>