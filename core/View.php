<?php

namespace app\core;

class View
{
    public string $title = '';

    public function renderView(string $view, $params = [])
    {
        $viewContent = $this->viewContent($view, $params);
        $layoutContent = $this->layoutContent();
        // Place view content inside layout
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        $layout = Application::$app->layout;
        if (Application::$app->controller)
            $layout = Application::$app->controller->layout;

        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function viewContent($view, $params)
    {
        // We are defining params in the foreach loop below and then include the view
        // so params can be accessible inside view

        foreach ($params as $key => $value)
            $$key = $value;

        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}