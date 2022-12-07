<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Validator;

use Exception;
use Wepesi\App\Providers\ValidatorProvider;

/**
 * Description of String
 *
 * @author Boss Ibrahim Mussa
 */
abstract class StringValidator extends ValidatorProvider {
    private string $field_value, $field_item;
    private array $source_data;
    public array $errors;
    private int $_min;
    private int $_max;

    /**
     *
     * @param string $item
     * @param string $value
     */
    public function __construct(string $item,string $value) {
        $this->errors = [];
        $this->_min = strlen($value);
        $this->_max = strlen($value);
        $this->source_data = [];
        $this->field_item = $item;
        $this->field_value = $value;
        parent::__construct();
    }

    /**
     *
     * @param int $rule
     *
     */
    public function min(int $rule):void
    {
        if (strlen($this->field_value) < $rule) {
            $message=[
                "type"=>"string.min",
                "message"=> "`$this->field_item` should have minimum of `$rule` characters",
                "label"=>$this->field_item,
                "limit"=>$rule
            ];
            $this->addError($message);
        }
    }

    /**
     *
     * @param int $rule
     *
     */
    public function max(int $rule)
    {
        $this->_max=$rule;
        if (strlen($this->field_value) > $rule) {
            $message = [
                "type" => "string.max",
                "message" => "`$this->field_item` should have maximum of `$rule` characters",
                "label" => $this->field_item,
                "limit" => $rule
            ];
            $this->addError($message);
        }
    }

    /**
     *
     */
    public function email()
    {
        if (!filter_var($this->field_value, FILTER_VALIDATE_EMAIL)) {
            $message = [
                "type" => "string.email",
                "message" => ("`$this->field_item` should be an email."),
                "label" => $this->field_item,
            ];
            $this->addError($message);
        }
    }

    /**
     *supported link :
     * http(s)://[domain].[extension] ,
     * http(s)://www.[domain].[extension],
     * www.[domain].[extension]
     *
     */
    public function url()
    {
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $this->field_value)) {
            $message = [
                "type" => "string.url",
                "message" => ("`{$this->field_item}` this should be a link(url)"),
                "label" => $this->field_item,
            ];
            $this->addError($message);
        }
    }

    /**
     *
     * @param string $key_to_match
     *
     */
    public function match(string $key_to_match)
    {
        $this->isString($key_to_match);
        if (isset($this->source_data[$key_to_match]) && (strlen($this->field_value)!= strlen($this->source_data[$key_to_match])) && ($this->field_value!=$this->source_data[$key_to_match])) {
            $message = [
                "type" => "string.match",
                "message" => "`$this->field_item` should match `$key_to_match`",
                "label" => $this->field_item,
            ];
            $this->addError($message);
        }
    }

    public function required()
    {
        $required_value= trim($this->field_value);
        if (strlen($required_value)==0) {
            $message = [
                "type"=> "string.required",
                "message" => "`$this->field_item` is required",
                "label" => $this->field_item,
            ];
            $this->addError($message);
        }
    }

    /**
     *
     * @param string $item_key
     * @return void
     */
    protected function isString(string $item_key): void
    {
        $field_to_check=!$item_key?$this->field_item:$item_key;
        $regex="#[a-zA-Z0-9]#";
        if(!preg_match($regex,$this->source_data[$field_to_check]) || strlen(trim($this->field_value))==0){
            $message=[
                    "type" => "string.unknown",
                    "message" => ("`$field_to_check` should be a string"),
                    "label" => $field_to_check,
                ];
            $this->addError($message);
        }
    }
}
