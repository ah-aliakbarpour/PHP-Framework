<?php

namespace app\core\form;

use app\core\Model;

class From
{

    public static function begin(string $action, string $method): From
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new From();
    }

    public static function end(): void
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute)
    {
        return new Field($model, $attribute);
    }
}