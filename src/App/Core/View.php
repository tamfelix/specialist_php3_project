<?php

namespace App\Core;


class View{

    public static function render($template, $location, $vars)
    {
        //echo __DIR__;
        $component = self::component($template, $location, $vars);
        //ob_start();
        //extract($component);
        //require __DIR__."/../../../resources/views/$location/$template.blade.php";
        return $component;
    }

    public static function component($template, $location, $vars){
        ob_start();
        extract($vars);
        require __DIR__."/../../../resources/views/$location/$template.blade.php";
        return ob_get_clean();
    }


}