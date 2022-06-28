<?php

namespace app\core;

class Session
{
    protected const FLASH_KEY = 'flash_massage';

    public function __construct()
    {
        session_start();

        // Mark sessions to be removed
        foreach ($_SESSION[self::FLASH_KEY] ?? [] as $key => $flashMassage)
            $_SESSION[self::FLASH_KEY][$key]['remove'] = true;
    }

    public function __destruct()
    {
        // Iterate over to remove marked sessions
        foreach ($_SESSION[self::FLASH_KEY] ?? [] as $key => $flashMassage)
            if ($flashMassage['remove'])
                unset($_SESSION[self::FLASH_KEY][$key]);
    }

    public function setFlash($key, $massage)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'removed' => false,
            'value' => $massage,
        ];
    }

    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'];
    }
}