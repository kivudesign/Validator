<?php
namespace Wepesi\app;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of String
 *
 * @author Ibrahim
 */
class VString {
    private $string_value;
    private $string_item;
    private $source_data;
    private $_errors;
    private $_min;
    private $_max;
    //put your code here
    function __construct(array $source,string $string_item=null,string $stringValue=null) {
        $this->string_value=$stringValue;
        $this->string_item=$string_item;
        $this->source_data=$source;
        $this->_max= $this->_min=0;
        $this->checkExist();
    }
    function min(int $rule_values=0){
        $min=is_integer($rule_values)? ((int)$rule_values>0?(int)$rule_values:0):0;
        if (strlen($this->string_value) < $min) {
            $message=[
                "type"=>"string.min",
                "message"=> "`{$this->string_item}` should have minimum of `{$min}` caracters",
                "label"=>$this->string_item,
                "limit"=>$min
            ];
            $this->addError($message);
        }
        return $this;
    }
    
    function max(int $rule_values=1){
        $max = is_integer($rule_values) ? ((int)$rule_values > 0 ? (int)$rule_values : 0):0;
        $this->_max=$max; 
        if (strlen($this->string_value) > $max) {
            $message = [
                "type" => "string.max",
                "message" => "`{$this->string_item}` should have maximum of `{$max}` caracters",
                "label" => $this->string_item,
                "limit" => $max
            ];
            $this->addError($message);
        }
        return $this;
    }

    function email(){
        if (!filter_var($this->string_value, FILTER_VALIDATE_EMAIL)) {
            $message = [
                "type" => "string.email",
                "message" => "`{$this->string_item}` this should be an email",
                "label" => $this->string_item,
            ];
            $this->addError($message);
        }
        return $this;
    }
    function url(){
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $this->string_value)) {
            $message = [
                "type" => "string.url",
                "message" => "`{$this->string_item}` this shoudl be a link(url)",
                "label" => $this->string_item,
            ];
            $this->addError($message);
        }
        return $this;
    }
    function match(string $key_tomatch){
        $this->checkExist($key_tomatch);
        if (isset($this->source_data[$key_tomatch]) && (strlen($this->string_value)!= strlen($this->source_data[$key_tomatch])) && ($this->string_value!=$this->source_data[$key_tomatch])) {
            $message = [
                "type" => "string.match",
                "message" => "`{$this->string_item}` should match {$key_tomatch}",
                "label" => $this->string_item,
            ];
            $this->addError($message);
        }
        return $this;
    }
    function required(){
        if (empty($this->string_value)&& $this->string_value != 0) {
            $message = [
                "type"=> "any.required",
                "message" => "`{$this->string_item}` is required",
                "label" => $this->string_item,
            ];
            $this->addError($message);
        }
        return $this;
    }
    private function checkExist(string $itemKey=null){
        $item_to_check=$itemKey?$itemKey:$this->string_item;
        if (!isset($this->source_data[$item_to_check])) {
            $message = [
                "type"=> "any.unknow",
                "message" => "`{$item_to_check}` is unknow",
                "label" => $item_to_check,
            ];
            $this->addError($message);
        }
        return true;
    }
    private function addError(array $value){
       return $this->_errors[]=$value;
    }
    function check(){
        return  $this->_errors;
    }
}
