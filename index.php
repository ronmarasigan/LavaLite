<?php
//app root
define('APP_ROOT', __DIR__);

//headers
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: strict-origin-when-cross-origin");
header_remove('X-Powered-By');

//App configurations
require_once 'config.php';

//Error reporting
if (IS_DEV) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
}

//use database query builder
require_once __DIR__ . '/scheme/Database.php';

//use helper functions
require_once __DIR__ . '/scheme/helpers.php';

//use router class
require_once __DIR__ . '/scheme/Router.php';
$router = new Router();

//call all routes
require_once  __DIR__ . '/routes.php';

//dispatch
$router->run();