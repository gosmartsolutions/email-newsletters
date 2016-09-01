<?php

require 'Config.php';
require 'HelperFunctions.php';

//Autoloads class files based on class name called
//This avoids having to add includes for every class file
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$db = Database::getInstance();
