<?php
defined('APP_ROOT') OR exit('No direct script access allowed');
/**
 * Global Helper Functions
 */
session_start();

//get base url
function base_url(): string
{
    $scheme = (
        (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
    ) ? 'https' : 'http';

    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';

    $path = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/\\');

    return $scheme . '://' . $host . ($path ? $path : '') . '/';
}


//generate url based on BASE_URL
function url(string $path = ''): string
{
    return rtrim(base_url(), '/') . '/' . ltrim($path, '/');
}

//generate csrf field
function csrf_field() {
    $router = new Router();
    return $router->csrf_field();
}

//set session flash data
function set_flash(string $key, string $message): void {
    $_SESSION['flash'][$key] = $message;
}

//get session flash data
function get_flash(string $key): ?string {
    if (isset($_SESSION['flash'][$key])) {
        $msg = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $msg;
    }
    return null;
}

//json response
function json_response($data, int $status = 200): never {
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

//Database connection
function db() {
    $db = new Database();
    return $db;
}

//escape output
function esc($var, $double_encode = TRUE): string|array
{
    if (empty($var))
		{
			return $var;
		}

		if (is_array($var))
		{
			foreach (array_keys($var) as $key)
			{
				$var[$key] = esc($var[$key], $double_encode);
			}

			return $var;
		}

		return htmlspecialchars($var, ENT_QUOTES, 'utf-8', $double_encode);
}