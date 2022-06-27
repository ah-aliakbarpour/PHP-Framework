<?php

namespace app\core;

class Router
{

    public Request $request;
    public Response $response;

    protected array $routes = [
        'get' => [],
        'post' => [],
    ];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        // If path does not start with /, add / to start
        if ($path[0] !== '/')
            $path = '/' . $path;

        // If path ends with /, remove / from end
        if ($path[-1] === '/')
            $path = substr($path, 0, -1);

        // Append to routes
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false)
        {
            $this->response->setStatusCode(404);
            return "Not found";
        }

        if (is_string($callback))
            return $this->renderView($callback);

        return call_user_func($callback);
    }

    public function renderView(string $view)
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/app.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view)
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }

}