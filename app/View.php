<?php
namespace App;

class View
{
    public static function make($viewName = null, array $customVars = array(), $arg = null)
    {
        // extracts variables
        extract($customVars);

        // includes template
        require_once viewsPath() . 'Template.php';
    }
}