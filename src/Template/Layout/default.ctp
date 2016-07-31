<!DOCTYPE html>
<html lang="en" class="<?php echo $htmlClasses; ?>">
<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>

    <?php
    $this->Html->css([
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css',
        //$bowerPath . 'font-awesome/css/font-awesome.min.css',
        'styles.css',
    ], [
        'block' => true
    ]);
    ?>
    <?= $this->fetch('css') ?>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo \Cake\Core\Configure::read('Site.name'); ?></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php echo $this->cell('Menu', ['principal']); ?>
            <?php echo $this->element('language-switcher'); ?>
        </div>
    </div>
</nav>

<div class="container">
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
</div>

<?php
echo $this->Html->script([
    'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js',
    'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js',
]/*, [
    'block' => true
]*/);
?>
<?= $this->fetch('script') ?>
</body>
</html>