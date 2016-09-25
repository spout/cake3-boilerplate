<?php
if (!isset($actions)) {
    $actions = [
        'view' => false,
        'edit' => true,
        'delete' => true,
    ];
}
?>
<div class="btn-group btn-group-xs">
    <?php
    if (!empty($actions['view'])) {
        echo $this->Html->link('<i class="fa fa-eye"></i>', ['action' => 'view', $singularVar['id']], ['class' => 'btn btn-default', 'escape' => false, 'title' => __("View")]);
    }
    if (!empty($actions['edit'])) {
        echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>', ['action' => 'edit', $singularVar['id']], ['class' => 'btn btn-default', 'escape' => false, 'title' => __("Edit")]);
    }
    if (!empty($actions['delete'])) {
        echo $this->Form->postLink('<i class="fa fa-trash"></i>', ['action' => 'delete', $singularVar['id']], ['class' => 'btn btn-danger', 'escape' => false, 'title' => __("Delete"), 'confirm' => __("Are you sure?")]);
    }
    ?>
</div>