<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Wepesi\App\Validator;

use Wepesi\App\Providers\ValidatorProvider;

/**
 * Description of VNumber
 *
 * @author Boss Ibrahim Mussa
 */
final class NumberValidator extends ValidatorProvider
{

    /**
     * @param string $item
     * @param array $data_source
     */
    function __construct(string $item, array $data_source)
    {
        $this->data_source = $data_source;
        $this->field_name = $item;
        $this->field_value = $data_source[$item];
        if ($this->isNumber()) {
            $this->field_value = $data_source[$item];
        }
        parent::__construct();
    }

    /**
     * @param int $rule
     * @return void
     */
    function min(int $rule)
    {
        if ($this->positiveParamMethod($rule)) return;
        if ((int)$this->field_value < $rule) {
            $message = [
                'type' => 'number.min',
                'message' => "`$this->field_name` should be greater than `$rule`",
                'label' => $this->field_name,
                'limit' => $rule
            ];
            $this->addError($message);
        }
    }

    /**
     * @param int $rule
     * @return void
     */
    function max(int $rule)
    {
        if ($this->positiveParamMethod($rule, true)) return;
        if ((int)$this->field_value > $rule) {
            $message = [
                'type' => 'number.max',
                'message' => "`$this->field_name` should be less than `$rule`",
                'label' => $this->field_name,
                'limit' => $rule
            ];
            $this->addError($message);
        }
    }

    /**
     *
     */
    function positive()
    {
        if ((int)$this->field_value < 0) {
            $message = [
                'type' => 'number.positive',
                'message' => "`$this->field_name` should be a positive number",
                'label' => $this->field_name,
                'limit' => 1
            ];
            $this->addError($message);
        }
    }

    /**
     * @return bool
     */
    protected function isNumber(): bool
    {
        $regex_string = '#[a-zA-Z]#';
        if (preg_match($regex_string, trim($this->data_source[$this->field_name])) || !is_integer($this->data_source[$this->field_name])) {
            $message = [
                'type' => 'number.unknown',
                'message' => "`$this->field_name` should be a number",
                'label' => $this->field_name,
            ];
            $this->addError($message);
            return false;
        }
        return true;
    }

    /**
     * @return string
     */
    protected function classProvider(): string
    {
        return 'number';
    }
}
