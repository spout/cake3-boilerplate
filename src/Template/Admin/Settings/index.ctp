<?php
$title = __("Settings");
$this->assign('title', $title);

$this->element('ace-editor');
?>
<h2><?php echo $title; ?></h2>
<table class="table table-hover table-condensed">
    <thead>
        <tr>
            <th><?php echo __("Filename"); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($files as $f): ?>
            <?php
            $basename = basename($f);
            ?>
            <tr<?php echo $basename == $file ? ' class="active"' : ''; ?>>
                <td><?php echo $this->Html->link($basename, ['action' => 'index', $basename]); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
if (!empty($file)) {
    echo $this->Form->create();
    echo $this->Form->input('content', ['label' => __("Content"), 'type' => 'textarea', 'data-editor' => 'yaml']);
    echo $this->Form->submit(__("Save"), ['class' => 'btn btn-primary']);
    echo $this->Form->end();
}
?>