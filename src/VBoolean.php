<?php

namespace Wepesi\App;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of String
 *
 * @author Domeshow
 */
class VBoolean
{
    private $string_value;
    private $string_item;
    private $source_data;
    private $_errors;
    /**
     * 
     * @param array $source
     * @param string $string_item
     * @param string $stringValue
     */
    function __construct(array $source, string $string_item = null)
    {
        $this->string_item = $string_item;
        $this->source_data = $source;
        $this->check_key = $this->checkExist();
        if ($this->check_key) {
            $this->string_value = $source[$string_item];
        };
    }

    /**
     * 
     * @param string $itemKey
     * @return boolean
     */
    private function checkExist(string $itemKey = null)
    {
        $item_to_check = $itemKey ? $itemKey : $this->string_item;
        $val = $this->source_data[$item_to_check];

        $regex = "/^(true|false)$/";
        if (!isset($this->source_data[$item_to_check])) {
            $message = [
                "type" => "any.unknow",
                "message" => "`{$item_to_check}` is unknow",
                "label" => $item_to_check,
            ];
            $this->addError($message);
            return false;
        } else if (!preg_match($regex, is_bool($val) ? ($val ? 'true' : 'false') : $val)) {
            $message = [
                "type" => "boolean.unknow",
                "message" => "`{$item_to_check}` shoud be a boolean",
                "label" => $item_to_check,
            ];
            $this->addError($message);
            return false;
        }
        return true;
    }

    function required()
    {
        $required_value = is_bool($this->string_value);
        if (empty($required_value)) {
            $message = [
                "type" => "any.required",
                "message" => "`{$this->string_item}` is required",
                "label" => $this->string_item,
            ];
            $this->addError($message);
        }
        return $this;
    }

    function isValid(string $value)
    {
        $passed_value = is_bool($value) ? ($value ? 'true' : 'false') : $value;
        $required_value = strtolower($passed_value);
        $check = $required_value == 'true' || $required_value == 'false';
        if (!($check)) {
            $message = [
                "type" => "boolean.required",
                "message" => "isValid param must be boolean but you put `{$required_value}` ",
                "label" => $this->string_item,
            ];
            $this->addError($message);
        } else {
            // $sting_value= is_bool($this->string_value);
            $incoming_value =  $this->string_value ? 'true' : 'false';

            if ($incoming_value != $required_value) {
                $message = [
                    "type" => "boolean.valid",
                    "message" => "`{$incoming_value}` is not validValue required. You must put `{$required_value}`",
                    "label" => $this->string_item,
                ];
                $this->addError($message);
            }
        }

        return $this;
    }

    /**
     * 
     * @param array $value
     * @return type
     */
    private function addError(array $value)
    {
        return $this->_errors[] = $value;
    }
    /**
     * 
     * @return type
     */
    function check()
    {
        return  $this->_errors;
    }
}
