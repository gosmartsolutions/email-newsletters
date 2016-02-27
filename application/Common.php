<?php
error_reporting(E_ALL);
ini_set("display_errors", "0");
require 'Config.php';
require 'HelperFunctions.php';

//Autoloads class files based on class name called
//This avoids having to add includes for every class file
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$db = Database::getInstance();
