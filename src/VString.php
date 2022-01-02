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
 * @author Boss Ibrahim Mussa
 */
class VString {
    private $string_value;
    private ?string $string_item;
    private array $source_data=[];
    private array $_errors=[];
    private int $_min=0;
    private int $_max=0;

    /**
     *
     * @param array $source
     * @param string|null $string_item
     */
    function __construct(array $source,string $string_item=null) {
        $this->string_item=$string_item;
        $this->source_data=$source;
        $this->_max= $this->_min=0;
        $this->check_key=$this->checkExist();
        if($this->check_key){
            $this->string_value=$source[$string_item];
        };
    }
    /**
     * 
     * @param int $rule_values
     * @return $this
     */
    function min(int $rule_values=0): VString
    {
        $min=is_integer($rule_values)? ((int)$rule_values>0?(int)$rule_values:0):0;
        if (strlen($this->string_value) < $min) {
            $message=[
                "type"=>"string.min",
                "message"=> i18n::translate("`%s` should have minimum of `%s` characters",[$this->string_item,$min]),
                "label"=>$this->string_item,
                "limit"=>$min
            ];
            $this->addError($message);
        }
        return $this;
    }
    /**
     * 
     * @param int $rule_values
     * @return $this
     */
    function max(int $rule_values=1): VString
    {
        $max = is_integer($rule_values) ? ((int)$rule_values > 0 ? (int)$rule_values : 0):0;
        $this->_max=$max; 
        if (strlen($this->string_value) > $max) {
            $message = [
                "type" => "string.max",
                "message" => i18n::translate("`%s` should have maximum of `%s` characters",[$this->string_item,$max]),
                "label" => $this->string_item,
                "limit" => $max
            ];
            $this->addError($message);
        }
        return $this;
    }
    /**
     * 
     * @return $this
     */
    function email(): VString
    {
        if (!filter_var($this->string_value, FILTER_VALIDATE_EMAIL)) {
            $message = [
                "type" => "string.email",
                "message" => i18n::translate("`%s` this should be an email",[$this->string_item]),
                "label" => $this->string_item,
            ];
            $this->addError($message);
        }
        return $this;
    }
    /**
     * 
     * @return $this
     */
    function url(): VString
    {
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $this->string_value)) {
            $message = [
                "type" => "string.url",
                "message" => i18n::translate("`{$this->string_item}` this should be a link(url)"),
                "label" => $this->string_item,
            ];
            $this->addError($message);
        }
        return $this;
    }
    /**
     * 
     * @param string $key_tomatch
     * @return $this
     */
    function match(string $key_tomatch){
        $this->checkExist($key_tomatch);
        if (isset($this->source_data[$key_tomatch]) && (strlen($this->string_value)!= strlen($this->source_data[$key_tomatch])) && ($this->string_value!=$this->source_data[$key_tomatch])) {
            $message = [
                "type" => "string.match",
                "message" => i18n::translate("`%s` should match %s",[$this->string_item,$key_tomatch]),
                "label" => $this->string_item,
            ];
            $this->addError($message);
        }
        return $this;
    }

    /**
     * @return $this
     */
    function required(): VString
    {
        $required_value= trim($this->string_value);
        if (empty($required_value)) {
            $message = [
                "type"=> "any.required",
                "message" => i18n::translate("`%s` is required",[$this->string_item]),
                "label" => $this->string_item,
            ];
            $this->addError($message);
        }
        return $this;
    }
    /**
     * 
     * @param string $itemKey
     * @return boolean
     */
    private function checkExist(string $itemKey=null){
        $item_to_check=$itemKey?$itemKey:$this->string_item;
        $regex="#[a-zA-Z0-9]#";
        $status_keys_exist=true;
        if (!isset($this->source_data[$item_to_check])) {
            $message = [
                "type"=> "any.unknow",
                "message" => i18n::translate("`%s` is unknow",[$item_to_check]),
                "label" => $item_to_check,
            ];
            $this->addError($message);
            return false;
        }else if(!preg_match($regex,$this->source_data[$item_to_check]) || strlen(trim($this->source_data[$item_to_check]))==0){
            $message=[
                    "type" => "string.unknow",
                    "message" => i18n::translate("`%s` should be a string",[$item_to_check]),
                    "label" => $item_to_check,
                ];
                $this->addError($message);
                return false;
        }
        return $status_keys_exist;
    }/**
     * 
     * @param array $value
     * @return void
 */
    private function addError(array $value): void
    {
        $this->_errors[] = $value;
    }/**
     * 
     * @return type
     */
    function check(){
        return  $this->_errors;
    }
}
