<?php

namespace app\traits;

trait ValidatePath
{
    public function validatePath($path)
    {
        // If path does not start with /, add / to start
        if ($path[0] !== '/')
            $path = '/' . $path;

        // If path ends with /, remove / from end
        if ($path[-1] === '/')
            $path = substr($path, 0, -1);

        return $path;
    }
}