<?php
$elFinderUrl = '/bower_components/elfinder/';
$elFinderConnectorUrl = dirname($_SERVER['SCRIPT_NAME']) . '/connector.php';
$lang = !empty($_GET['lang']) ? $_GET['lang'] : 'en';
$theme = !empty($_GET['theme']) ? $_GET['theme'] : 'smoothness';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>elFinder</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2" />

    <!-- jQuery and jQuery UI (REQUIRED) -->
    <link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/<?php echo $theme; ?>/jquery-ui.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

    <!-- elFinder CSS (REQUIRED) -->
    <link rel="stylesheet" type="text/css" href="<?php echo $elFinderUrl; ?>css/elfinder.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $elFinderUrl; ?>css/theme.css">

    <!-- elFinder JS (REQUIRED) -->
    <script src="<?php echo $elFinderUrl; ?>js/elfinder.min.js"></script>

    <!-- elFinder translation (OPTIONAL) -->
    <?php if($lang != 'en'): ?>
    <script src="<?php echo $elFinderUrl; ?>js/i18n/elfinder.<?php echo $lang; ?>.js"></script>
    <?php endif; ?>

    <!-- elFinder initialization (REQUIRED) -->
    <script type="text/javascript" charset="utf-8">
        // Documentation for client options:
        // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
        $(document).ready(function() {
            $('#elfinder').elfinder({
                url : '<?php echo $elFinderConnectorUrl; ?>',
                lang: '<?php echo $lang; ?>'
            });
        });
    </script>
</head>
<body>

<!-- Element where elFinder will be created (REQUIRED) -->
<div id="elfinder"></div>

</body>
</html>