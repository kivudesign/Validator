<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Wepesi\app;

/**
 * Description of VNumber
 *
 * @author Lenovo
 */
class VNumber {
    //put your code here
    private $string_value;
    private $string_item;
    private $source_data;
    private $_errors;
    private $_min;
    private $_max;
    
    function __construct(array $source,string $string_item) {
        $this->source_data=$source;        
        $this->string_item=$string_item;
        $this->_max= $this->_min=0;
        if($this->checkExist()){
            $this->string_value=$source[$string_item];
        }
    }
    function min(int $min_values){
        if ((int) $this->string_value < $min_values) {
            $message=[
                "type"=>"number.min",
                "message"=> "`{$this->string_item}` should be greater than  `{$min_values}`",
                "label"=>$this->string_item,
                "limit"=>$min_values
            ];
            $this->addError($message);
        }
        return $this;
    }
    function max(int $min_values){
        if ((int) $this->string_value > $min_values) {
            $message=[
                "type"=>"number.max",
                "message"=> "`{$this->string_item}` should be less than  `{$min_values}`",
                "label"=>$this->string_item,
                "limit"=>$min_values
            ];
            $this->addError($message);
        }
        return $this;
    }
    function positive(int $min_values){
        if ((int) $this->string_value < 0) {
            $message=[
                "type"=>"number.positive",
                "message"=> "`{$this->string_item}` should be a positive number",
                "label"=>$this->string_item,
                "limit"=>1
            ];
            $this->addError($message);
        }
        return $this;
    }
    function required(){
        $required_value= trim($this->string_value);
        if (empty($required_value)) {
            $message = [
                "type"=> "any.required",
                "message" => "`{$this->string_item}` is required",
                "label" => $this->string_item,
            ];
            $this->addError($message);
        }
        return $this;
    }
//    
    private function checkExist(string $itemKey=null){
        $item_to_check=$itemKey?$itemKey:$this->string_item;
        $regex_string="#[a-zA-Z]#";
        $status_key_exist=true;
        if (!isset($this->source_data[$item_to_check])) {
            $message = [
                "type"=> "any.unknow",
                "message" => "`{$item_to_check}` is unknow",
                "label" => $item_to_check,
            ];
            $this->addError($message);
            $status_key_exist=false;
        }else if (preg_match($regex_string,trim($this->source_data[$item_to_check])) || !is_integer($this->source_data[$item_to_check])) {            
            $message = [
                "type"=> "number.unknow",
                "message" => "`{$item_to_check}` should be a number",
                "label" => $item_to_check,
            ];
            $this->addError($message);
            $status_key_exist=false;
        }
        return $status_key_exist;
    }
    private function addError(array $value){
       return $this->_errors[]=$value;
    }
    function check(){
        return  $this->_errors;
    }
}
