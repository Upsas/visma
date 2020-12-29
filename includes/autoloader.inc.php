<?php
spl_autoload_register('classLoader');
function classLoader($class)
{
    $path = "./classes/" . ucfirst($class) . ".class.php";
    if (!file_exists($path)) {
        return false;
    }
    include_once $path;
}
