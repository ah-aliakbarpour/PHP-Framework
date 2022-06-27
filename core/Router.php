<?php

namespace app\core;

use app\traits\ValidatePath;

class Router
{
    use ValidatePath;

    public Request $request;
    public Response $response;

    protected array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $path = $this->validatePath($path);

        // Append to routes
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $path = $this->validatePath($path);

        // Append to routes
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        // This route not defined
        if ($callback === false)
        {
            $this->response->setStatusCode(404);
            return $this->renderView('errors/404');
        }

        // Directly return view
        if (is_string($callback))
            return $this->renderView($callback);

        // Because of using controller, we should have an instance of controller to be able to use '$this' keyword
        // inside controller, so we create an instance
        if (is_array($callback))
            $callback[0] = new $callback[0]();

        return call_user_func($callback);
    }

    public function renderView(string $view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->viewContent($view, $params);
        // Place view content inside layout
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/app.php";
        return ob_get_clean();
    }

    protected function viewContent($view, $params)
    {
        foreach ($params as $key => $value)
            $$key = $value;

        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }

}