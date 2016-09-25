<?php
use Cake\Core\Configure;

$locales = Configure::read('Site.locales');
?>
<?php /*$this->append('script'); ?>
<script>
    $(function() {
        $('button.delete').on('click', function() {
            $(this).closest('fieldset').remove();
        });
    });
</script>
<?php $this->end();*/ ?>

<?php echo $this->Form->create($menu); ?>
<?php foreach($locales as $lang => $locale): ?>
    <?php echo $this->Form->input(sprintf('title_%s', $lang), ['label' => __("Title ({lang})", ['lang' => $lang])]); ?>
<?php endforeach; ?>

<p><a href="#collapse-expert-menu" data-toggle="collapse"><?php echo __("Expert parameters"); ?></a></p>
<div class="collapse" id="collapse-expert-menu">
    <?php echo $this->Form->input('slug', ['label' => __("Slug")]); ?>
    <?php echo $this->Form->input('attributes', ['label' => __("Attributes")]); ?>
</div>

<?php
$items = $menu->menu_items;
if (is_null($items)) {
    $items = [];
}
array_push($items, [], [], []);
?>
<?php foreach ($items ?:[] as $k => $item): ?>
    <?php echo $this->Form->input(sprintf('menu_items.%d.id', $k)); ?>
    <fieldset>
        <legend><?php echo __("Menu item {number}", ['number' => $k + 1]); ?><?php if(empty($item->id)): ?> (<?php echo __("new"); ?>)<?php endif; ?></legend>
        <div class="row">
            <div class="col-sm-12">
                <?php echo $this->Form->input(sprintf('menu_items.%d.association', $k), ['label' => __("Associated page"), 'options' => $associations, 'empty' => '-']); ?>
            </div>
            <?php /*
            <?php echo $this->Form->input(sprintf('menu_items.%d.model', $k), ['label' => __("Model")]); ?>
            <?php echo $this->Form->input(sprintf('menu_items.%d.foreign_key', $k), ['label' => __("Foreign key")]); ?>
            */?>
            <?php foreach($locales as $lang => $locale): ?>
                <div class="col-sm-6">
                    <?php echo $this->Form->input(sprintf('menu_items.%d.title_%s', $k, $lang), ['label' => __("Title ({lang})", ['lang' => $lang])]); ?>
                </div>
            <?php endforeach; ?>
            <?php foreach($locales as $lang => $locale): ?>
                <div class="col-sm-6">
                    <?php echo $this->Form->input(sprintf('menu_items.%d.url_%s', $k, $lang), ['label' => __("URL ({lang})", ['lang' => $lang])]); ?>
                </div>
            <?php endforeach; ?>
            <div class="col-sm-12">
                <?php echo $this->Form->input(sprintf('menu_items.%d.sort', $k), ['label' => __("Sort order")]); ?>
            </div>
            <div class="col-sm-12">
                <p><a href="#collapse-expert-<?php echo $k; ?>" data-toggle="collapse"><?php echo __("Expert parameters"); ?></a></p>
                <div class="collapse" id="collapse-expert-<?php echo $k; ?>">
                    <?php echo $this->Form->input(sprintf('menu_items.%d.route', $k), ['label' => __("Route"), 'type' => 'textarea']); ?>
                    <?php echo $this->Form->input(sprintf('menu_items.%d.attributes', $k), ['label' => __("HTML attributes")]); ?>
                </div>
            </div>
        </div>

        <?php if(!empty($item->id)): ?>
            <?php /*
            <button type="button" class="btn btn-danger btn-xs delete"><?php echo __("Delete"); ?></button>
            */?>
            <?php echo $this->Form->input(sprintf('menu_items.%d.delete', $k), ['label' => __("Delete"), 'type' => 'checkbox']); ?>
        <?php endif; ?>
    </fieldset>
<?php endforeach; ?>

<?php echo $this->Form->submit(__("Save")); ?>
<?php echo $this->Form->end(); ?>