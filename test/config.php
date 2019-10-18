<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'php_crud');
define('DB_HOST', 'localhost');

$link = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($link->connect_errno) {
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}