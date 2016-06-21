<?php
namespace App\Lib;

use Cake\Utility\Inflector;

class Utils
{
    public static function slug($string, $replacement = '-')
    {
        return strtolower(Inflector::slug($string, $replacement));
    }
}