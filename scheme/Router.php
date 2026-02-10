<?php
defined('APP_ROOT') OR exit('No direct script access allowed');
/**
 * Simple Router Class based on LavaLust
 * Ronald M. Marasigan
 */
class Router
{
    private array $routes = [];
    private array $global_middleware = [];
    private string $csrf_token = '';

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        $this->csrf_token = $_SESSION['csrf_token'];
    }

    public function get(string $path, string|callable $handler, array $middleware = []): self
    {
        $this->add_route('GET', $path, $handler, $middleware);
        return $this;
    }

    public function post(string $path, string|callable $handler, array $middleware = []): self
    {
        $this->add_route('POST', $path, $handler, $middleware);
        return $this;
    }

    public function put(string $path, string|callable $handler, array $middleware = []): self
    {
        $this->add_route('PUT', $path, $handler, $middleware);
        return $this;
    }

    public function patch(string $path, string|callable $handler, array $middleware = []): self
    {
        $this->add_route('PATCH', $path, $handler, $middleware);
        return $this;
    }

    public function delete(string $path, string|callable $handler, array $middleware = []): self
    {
        $this->add_route('DELETE', $path, $handler, $middleware);
        return $this;
    }

    public function any(string $path, string|callable $handler, array $middleware = []): self
    {
        $this->add_route('ANY', $path, $handler, $middleware);
        return $this;
    }

    public function group(array $attributes, callable $callback): self
    {
        $previous_routes_count = count($this->routes);

        $callback($this);

        $new_routes = array_slice($this->routes, $previous_routes_count);

        foreach ($new_routes as &$route) {
            if (!empty($attributes['prefix'])) {
                $prefix = trim($attributes['prefix'], '/');
                if ($prefix !== '') {
                    $route['path'] = $prefix . '/' . ltrim($route['path'], '/');
                }
            }

            if (!empty($attributes['middleware'])) {
                $route['middleware'] = array_merge(
                    (array) $attributes['middleware'],
                    $route['middleware']
                );
            }
        }

        array_splice($this->routes, $previous_routes_count, count($new_routes), $new_routes);

        return $this;
    }

    private function add_route(string $method, string $path, string|callable $handler, array $middleware): void
    {
        $this->routes[] = [
            'method'     => $method,
            'path'       => trim($path, '/'),
            'handler'    => $handler,
            'middleware' => $middleware,
        ];
    }

    public function add_global_middleware(callable $middleware): self
    {
        $this->global_middleware[] = $middleware;
        return $this;
    }

    public function csrf_field(): void
    {
        echo '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($this->csrf_token) . '">';
    }

    public function is_csrf_valid(): bool
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        if (!in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            return true;
        }

        $submitted = $_POST['csrf_token'] ?? '';
        return $submitted !== '' && hash_equals($this->csrf_token, $submitted);
    }

    private function regenerate_csrf(): void
    {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        $this->csrf_token = $_SESSION['csrf_token'];
    }

    public function get_base_path(): string
    {
        $script = $_SERVER['SCRIPT_NAME'] ?? '';

        $script = preg_replace('#/index\.php$#', '', $script);
        $script = preg_replace('#/index$#', '', $script);

        $base = '/' . trim($script, '/') . '/';

        if ($base === '//') {
            $base = '/';
        }

        return $base;
    }

    public function run(): void
    {
        $base_path = $this->get_base_path();

        $request_method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

        if ($uri === null) {
            $uri = '/';
        }

        if (str_starts_with($uri, $base_path)) {
            $uri = substr($uri, strlen($base_path) - 1) ?: '/';
        }

        $uri = trim($uri, '/');
        $uri_parts = $uri === '' ? [] : explode('/', $uri);

        foreach ($this->routes as $route) {
            $method_match = $route['method'] === 'ANY' || $route['method'] === $request_method;
            if (!$method_match) {
                continue;
            }

            $route_parts = $route['path'] === '' ? [] : explode('/', $route['path']);
            $params = [];
            $match = true;
            $i = 0;

            while ($i < count($route_parts)) {
                $part = $route_parts[$i];

                if (preg_match('/^{(.+?)\?}$/', $part, $m)) {
                    $param_name = $m[1];
                    $params[$param_name] = $uri_parts[$i] ?? null;
                } elseif (preg_match('/^{(.+?)}$/', $part, $m)) {
                    $param_name = $m[1];
                    if (!isset($uri_parts[$i])) {
                        $match = false;
                        break;
                    }
                    $params[$param_name] = $uri_parts[$i];
                } else {
                    if (!isset($uri_parts[$i]) || $part !== $uri_parts[$i]) {
                        $match = false;
                        break;
                    }
                }

                $i++;
            }

            if ($i < count($uri_parts)) {
                $match = false;
            }

            if (!$match) {
                continue;
            }

            $all_middleware = array_merge(
                $this->global_middleware,
                $route['middleware']
            );

            try {
                foreach ($all_middleware as $mw) {
                    $continue = $mw($request_method, $params);
                    if ($continue === false) {
                        http_response_code(403);
                        echo "Access denied by middleware";
                        exit;
                    }
                }

                if (in_array($request_method, ['POST', 'PUT', 'PATCH', 'DELETE'])
                    && isset($_POST['csrf_token'])           // ← only validate if field was sent
                    && !$this->is_csrf_valid()) {
                    http_response_code(403);
                    die('CSRF token validation failed.');
                }

                $this->execute_handler($route['handler'], $params);

                if (in_array($request_method, ['POST', 'PUT', 'PATCH', 'DELETE'])) {
                    $this->regenerate_csrf();
                }

            } catch (Exception $e) {
                http_response_code(500);
                echo "Server error: " . htmlspecialchars($e->getMessage());
                exit;
            }

            return;
        }

        http_response_code(404);
        include dirname(__DIR__) . '/views/errors/404.php';
        exit;
    }

    private function execute_handler(string|callable $handler, array $params): void
    {
        if (is_callable($handler)) {
            call_user_func_array($handler, $params);
            return;
        }

        $file = $handler;

        if (str_starts_with($file, '/') || preg_match('#^[A-Z]:[\\\\/]#i', $file)) {
            // keep as is
        }
        elseif (str_starts_with($file, './') || str_starts_with($file, '../')) {
            $file = __DIR__ . '/' . ltrim($file, './');
        }
        else {
            $file = APP_ROOT . '/' . $file;
        }

        if (!str_ends_with($file, '.php')) {
            $file .= '.php';
        }

        if (file_exists($file)) {
            extract($params);
            include $file;
            return;
        }

        http_response_code(500);
        echo "500 - Handler not found: " . htmlspecialchars($file);
        exit;
    }
}