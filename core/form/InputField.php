<?php

namespace app\core\form;

use app\core\Model;

class InputField extends BaseField
{
    public string $type;

    public function __construct(Model $model, string $attribute, string $type = 'text')
    {
        $this->type = $type;
        parent::__construct($model, $attribute);
    }

    public function renderInput(): string
    {
        return sprintf('<input type="%s" name="%s" value="%s" class="form-control %s">',
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
        );
    }
}
