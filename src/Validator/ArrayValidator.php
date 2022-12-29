<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Validator;

use Wepesi\App\Providers\ValidatorProvider;

class ArrayValidator extends ValidatorProvider
{
    public function __construct(string $item, array $data_source=[],string $class_name="")
    {
        $this->errors = [];
        $this->data_source = $data_source;
        $this->field_name = $item;
        $this->field_value = $data_source[$item];
        $this->class_provider = $class_name;
         parent::__construct();
    }

    public function min(int $rule)
    {
        // TODO: Implement min() method.
    }

    public function max(int $rule)
    {
        // TODO: Implement max() method.
    }

}