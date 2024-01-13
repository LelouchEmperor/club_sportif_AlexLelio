<?php
    // autoloader.php
    // Autoloading
    function myAutoloader($className) {
        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        $classFile = __DIR__ . '/classes/chemin/' . $className . '.php';
    if (file_exists($classFile)) {
        require_once($classFile);
    }
    }
    spl_autoload_register('myAutoloader');
?>