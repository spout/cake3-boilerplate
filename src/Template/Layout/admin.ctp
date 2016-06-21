<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo __("Administration"); ?> : <?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only"><?php echo __("Toggle navigation"); ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php echo $this->Html->link(__("Administration"), ['prefix' => 'admin', 'controller' => 'dashboard'], ['class' => 'navbar-brand']); ?>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3">
            <?php
            $navs = [
                ['title' => __("Contents"), 'icon' => 'pencil', 'url' => ['controller' => 'Contents', 'action' => 'index']],
                ['title' => __("Menus"), 'icon' => 'link', 'url' => ['controller' => 'Menus', 'action' => 'index']],
                ['title' => __("Users"), 'icon' => 'users', 'url' => ['controller' => 'Users', 'action' => 'index']],
                ['title' => __("Contacts"), 'icon' => 'envelope', 'url' => ['controller' => 'Contacts', 'action' => 'index']],
                ['title' => __("File manager"), 'icon' => 'folder', 'url' => ['controller' => 'FileManager', 'action' => 'index']],
                ['title' => __("Settings"), 'icon' => 'cogs', 'url' => ['controller' => 'Settings', 'action' => 'index']],
            ];
            ?>
            <ul class="nav nav-pills nav-stacked">
                <?php foreach($navs as $nav): ?>
                    <li<?php echo $this->request->params['controller'] == $nav['url']['controller'] ? ' class="active"' : ''; ?>>
                        <?php echo $this->Html->link(sprintf('<i class="fa fa-%s"></i> %s', $nav['icon'], $nav['title']), $nav['url'], ['escape' => false]); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col-sm-9">
            <?= $this->Flash->render(); ?>
            <?= $this->fetch('content'); ?>
            <?= $this->fetch('action_link_forms'); ?>
        </div>
    </div>
</div>

<?= $this->element('modal', ['id' => 'modal-ajax']); ?>

<?= $this->fetch('script') ?>

<?php /*
<script>
    $(function() {
        $(document).on('click', 'td.actions a', function() {
            var $modal = $('#modal-ajax').modal();
            var $modalContent = $modal.find('.modal-content');

            $modalContent.load($(this).attr('href'), function () {

            });
        });
    });
</script>
*/?>
</body>
</html>