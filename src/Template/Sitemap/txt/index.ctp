<?php
use Cake\Routing\Router;

if (!empty($urls)) {
    $lines = [];
    foreach ($urls as $table => $rows) {
        foreach ($rows as $row) {
            $lines[] = Router::url($row->absoluteUrl, true);
        }
    }
    echo implode(PHP_EOL, $lines);
}