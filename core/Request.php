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
}