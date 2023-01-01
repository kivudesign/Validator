<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Validator;

use Wepesi\App\Providers\ValidatorProvider;

class ArrayValidator extends ValidatorProvider
{
    /**
     * @param string $item field name
     * @param array $data_source resource where data will come from
     */
    public function __construct(string $item, array $data_source=[])
    {
        $this->errors = [];
        $this->data_source = $data_source;
        $this->field_name = $item;
        $this->field_value = $data_source[$item];
        $this->class_provider = "array";
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