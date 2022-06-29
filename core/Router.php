<?php

namespace app\core;

use app\core\exception\NotFoundException;
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
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        // This route not defined
        if ($callback === false)
            throw new NotFoundException();

        // Directly return view
        if (is_string($callback))
            return Application::$app->view->renderView($callback);

        // Because of using controller, we should have an instance of controller to be able to use '$this' keyword
        // inside controller, so we create an instance
        if (is_array($callback))
        {
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach ($controller->getMiddleware() as $middleware) {
                $middleware->execute();
            }
        }

        return call_user_func($callback, $this->request, $this->response);
    }
}