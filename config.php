<?php
require_once 'messages.php';

//site specific configuration declartion
define( 'BASE_PATH', 'http://localhost/');
define( 'DB_HOST', 'localhost' );
define( 'DB_USERNAME', 'root');
define( 'DB_PASSWORD', 'root');
define( 'DB_NAME', 'final_assignment');

function __autoload($class)
{
    $parts = explode('_', $class);
    $path = implode(DIRECTORY_SEPARATOR,$parts);
    require_once $path . '.php';
}
