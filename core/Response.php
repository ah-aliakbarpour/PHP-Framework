<?php

namespace app\core;

use app\traits\ValidatePath;

class Response
{
    use ValidatePath;

    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    public function redirect($path)
    {
        $path = $this->validatePath($path);

        header('Location: ' . $path);
    }
}