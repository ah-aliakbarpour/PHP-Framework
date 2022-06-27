<?php

namespace app\core;

use app\traits\ValidatePath;

class Request
{
    use ValidatePath;

    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '';
        $position = strpos($path, '?');

        $path = $this->validatePath($path);

        // Path ends when first ? appear
        if ($position !== false)
            $path = substr($path, 0, $position);

        return $path;
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getBody()
    {
        $body = [];

        if ($this->getMethod() === 'get')
            foreach ($_GET as $key => $value)
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);

        if ($this->getMethod() === 'post')
            foreach ($_POST as $key => $value)
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);

        return $body;
    }
}