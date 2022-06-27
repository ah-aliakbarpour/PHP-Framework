<?php

namespace app\core;

class Request
{

    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '';
        $position = strpos($path, '?');

        // If path ends with /, remove / from end
        if ($path[-1] === '/') {
            $path = substr($path, 0, -1);
        }

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