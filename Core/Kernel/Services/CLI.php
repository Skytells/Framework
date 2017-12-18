<?php

set_include_path(implode(PATH_SEPARATOR, array(
    str_replace("Services", "Units",__DIR__),
    str_replace("Services", "Units", __DIR__ . '/ConsoleKit'),
    str_replace("Services", "Units",get_include_path())
)));

spl_autoload_register(function($className) {
    if (substr($className, 0, 10) === 'ConsoleKit') {
        $filename = str_replace('\\', DIRECTORY_SEPARATOR, trim($className, '\\')) . '.php';
        require_once $filename;
    }
});
