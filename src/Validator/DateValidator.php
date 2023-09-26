<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */


namespace Wepesi\App\Validator;

use Wepesi\App\Providers\ValidatorProvider;

/**
 * Description of VDate
 *
 * @author Boss Ibrahim Mussa
 */
final class DateValidator extends ValidatorProvider
{

    /**
     * @param string $item
     * @param array $data_source
     */
    public function __construct(string $item, array $data_source)
    {
        parent::__construct($item, $data_source);
        $this->checkExist();
    }

    /**
     * @return void
     */
    public function now()
    {
        $min_date_time = strtotime('now');
        $min_date = date('d/F/Y', $min_date_time);
        $date_value_time = strtotime($this->field_value);
        if ($date_value_time < $min_date_time) {
            $this->message_error_builder
                ->type($this->typeError('now'))
                ->message("`$this->field_name` should be greater than now")
                ->label($this->field_name)
                ->limit($min_date);
            $this->addError($this->message_error_builder);
        }
    }

    /**
     * @param string|null $times
     * @return  void
     * while trying to get day validation use this module
     */
    public function today(string $times = null)
    {
        $min_date_time = strtotime("now {$times}");
        $min_date = date('d/F/Y', $min_date_time);
        $date_value_time = strtotime($this->field_value);
        if ($date_value_time > $min_date_time) {
            $this->message_error_builder
                ->type($this->typeError('now'))
                ->message("`$this->field_name` should be greater than today ")
                ->label($this->field_name)
                ->limit($min_date);
            $this->addError($this->message_error_builder);
        }
    }

    /**
     * @param string|null $rule
     * @return void
     * get the min date control from the given date
     */
    public function min($rule)
    {
        /**
         * $regex= "#[a-zA-Z]#";
         * $time= preg_match($regex,$rule_values);
         * $con=!$time?$time:(int)$time;
         * in case the parameters are integers
         */
        $rule = $rule ?? 'now';
        $min_date_time = strtotime($rule);
        $min_date = date('d/F/Y', $min_date_time);
        $date_value_time = strtotime($this->field_value);
        if ($date_value_time > $min_date_time) {
            $this->message_error_builder
                ->type($this->typeError('min'))
                ->message("`$this->field_name` should be greater than `$min_date`")
                ->label($this->field_name)
                ->limit($min_date);
            $this->addError($this->message_error_builder);
        }
    }

    /**
     * @param string|null $rule
     * @return void
     * while try to check maximum date of a defined period use this module
     */
    public function max($rule)
    {
        $rule = $rule ?? 'now';
        $max_date_time = strtotime($rule);
        $max_date = date('d/F/Y', $max_date_time);
        $date_value_time = strtotime($this->field_value);
        if ($max_date_time < $date_value_time) {
            $this->message_error_builder
                ->type($this->typeError('max'))
                ->message("`$this->field_name` should be less than `$max_date`")
                ->label($this->field_name)
                ->limit($max_date);
            $this->addError($this->message_error_builder);
        }
    }

    /**
     * @param string|null $itemKey
     * @return void
     */
    protected function checkExist(string $itemKey = null): void
    {
        $item_to_check = $itemKey ?? $this->field_name;
        $regex = '#[a-zA-Z0-9]#';
        if (!isset($this->data_source[$item_to_check])) {
            $this->message_error_builder
                ->type('any.unknown')
                ->message("`$item_to_check` is unknown")
                ->label($item_to_check);
            $this->addError($this->message_error_builder);
        } else if (!preg_match($regex, $this->data_source[$item_to_check]) || strlen(trim($this->data_source[$item_to_check])) == 0) {
            $this->message_error_builder
                ->type($this->typeError('unknown'))
                ->message("`$item_to_check` should be a date.")
                ->label($item_to_check);
            $this->addError($this->message_error_builder);
        }
    }
}