<?php
if ($value) {
    $class = 'success';
    $icon = 'check';
    $label = __("Yes");
} else {
    $class = 'danger';
    $icon = 'times';
    $label = __("No");
}
//echo sprintf('<span class="label label-%s"><i class="fa fa-%s"></i> %s</span>', $class, $icon, $label);
echo sprintf('<span class="label label-%s">%s</span>', $class, $label);