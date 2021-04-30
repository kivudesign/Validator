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
    private $_errors;
    private $_min;
    private $_max;
    
    function __construct(string $string_item) {
        $this->string_value=$stringValue;
        $this->string_item=$string_item;
        $this->_max= $this->_min=0;
    }
    function min(){}
    function max(){}
    function positive(){}
    function bolean(){}
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
    private function addError(array $value){
       return $this->_errors[]=$value;
    }
    function check(){
        return  $this->_errors;
    }
}
