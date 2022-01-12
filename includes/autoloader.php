<?php
    spl_autoload_register(function ($class_name) {
        if($class_name == "Main"){
            include $class_name . '.php';
        }
        include 'components/'.$class_name.'/'.$class_name . '.php';
    });

?>