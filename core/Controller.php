<?php

namespace app\core;

class Controller
{
    public string $layout = 'app';

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function render(string $view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }
}