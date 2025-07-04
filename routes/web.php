<?php

$basePath = dirname($_SERVER['SCRIPT_NAME']);
$route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (strpos($route, $basePath) === 0) {
    $route = substr($route, strlen($basePath));
}
if ($route == '' || $route == false) {
    $route = '/';
}

switch ($route) {
    case '/':
        echo 'Home';
        break;
    
    default:
        echo '404 Not Found';
        break;
}