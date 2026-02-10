<?php

// Global middleware (optional)
$router->add_global_middleware(function ($method, $params) {
    error_log("Request: $method " . $_SERVER['REQUEST_URI']);
    return true;
});

// Admin group with prefix and extra middleware
$router->group([
    'prefix'     => 'admin',
    'middleware' => [
        function () {
            if (empty($_SESSION['is_admin'])) {
                http_response_code(403);
                die('Admin access required');
                return false;
            }
            return true;
        }
    ]
], function ($router) {
    $router->get('/dashboard', function () {
        echo "Admin Dashboard";
    });

    $router->get('/users/{id?}', function ($id = null) {
        echo $id ? "Admin viewing user $id" : "Admin user list";
    });

    // Nested group (prefix stacks → /admin/api/users)
    $router->group(['prefix' => 'api'], function ($router) {
        $router->get('/users', function () {
            echo "API: List users (admin only)";
        });
    });
});

// Public routes (no prefix)
$router->get('/', function() {
    echo 'Homapage';
});

$router->get('/profile/{username?}', function ($username = null) {
    echo $username ? "Profile: $username" : "My profile";
});

$router->post('/login', function () {
    // ... login logic ...
    echo "Logged in!";
});

$router->get('about-us/{username?}', 'views/about.php');

$router->group(['prefix' => '/chat'], function($router) {
    $router->get('/user', function() {
        echo 'User chat';
    });
});