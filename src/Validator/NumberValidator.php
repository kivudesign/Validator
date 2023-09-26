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
    public function __construct(string $item, array $data_source)
    {
        parent::__construct($item, $data_source);
        $this->isNumber();
    }

    /**
     * @param int $rule
     * @return void
     */
    public function min(int $rule)
    {
        if ((int)$this->field_value < $rule) {
            $this->message_error_builder
                ->type($this->typeError('min'))
                ->message("`$this->field_name` should be greater than `$rule`")
                ->label($this->field_name)
                ->limit($rule);
            $this->addError($this->message_error_builder);
        }
    }

    /**
     * @param int $rule
     * @return void
     */
    public function max(int $rule)
    {
        if ($this->checkNotPositiveParamMethod($rule, true)) return;
        if ((int)$this->field_value > $rule) {
            $this->message_error_builder
                ->type($this->typeError('max'))
                ->message("`$this->field_name` should be less than `$rule`")
                ->label($this->field_name)
                ->limit($rule);
            $this->addError($this->message_error_builder);
        }
    }

    /**
     *
     */
    public function positive()
    {
        if ((int)$this->field_value < 0) {
            $this->message_error_builder
                ->type($this->typeError('positive'))
                ->message("`$this->field_name` should be a positive number")
                ->label($this->field_name)
                ->limit(1);
            $this->addError($this->message_error_builder);
        }
    }
    /**
     *
     */
    public function negative()
    {
        if ((int)$this->field_value > 0) {
            $this->message_error_builder
                ->type($this->typeError('negative'))
                ->message("`$this->field_name` should be a negative number")
                ->label($this->field_name)
                ->limit(1);
            $this->addError($this->message_error_builder);
        }
    }

    /**
     * @return bool
     */
    protected function isNumber(): bool
    {
        $regex_string = '#[a-zA-Z]#';
        if (preg_match($regex_string, trim($this->data_source[$this->field_name])) || !is_integer($this->data_source[$this->field_name])) {
            $this->message_error_builder
                ->type($this->typeError('unknown'))
                ->message("`$this->field_name` should be a number")
                ->label($this->field_name);
            $this->addError($this->message_error_builder);
            return false;
        }
        return true;
    }
}
