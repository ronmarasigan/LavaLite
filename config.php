<?php
/**
 * App configurations
 */

//Dev or Prod
define('IS_DEV', in_array($_SERVER['REMOTE_ADDR'] ?? '', ['127.0.0.1', '::1']));

//Database Config
define('DB_DRIVER', '');
define('DB_HOST', '');
define('DB_PORT', '');
define('DB_NAME', '');
define('DB_USERNAME', '');
define('DB_PASSWORD', '');
define('DB_CHARSET', '');
define('DB_PREFIX', '');
define('DB_PATH', '');

