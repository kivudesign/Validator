<?php
namespace Wepesi\app;

class Validate{
    private $_errors;
    private $_passed;
    function __construct()
    {
        $this->_errors=[];
        $this->_passed=false;
    }
    /**
     * 
     */
    function check($source,array $items=[]){
        foreach($items as $item=>$rules){
            foreach($rules as $rule=>$rule_values){
                // check if the item existe on the source array $_array_name[$item]
                if(isset($source[$item])){
                    $value = trim($source[$item]);
                    // if the rele defined is required
                    if ($rule == 'required' && empty($value)) {
                        $this->addError("`{$item}` is required");
                    }else if(!empty($value)){
                        switch($rule){
                            // check for minimu input lenght of a string
                            case "min":
                                // check is the value entre is an integer
                                // and verifier if it is a possitive number, in order to check the minimum length
                                $min=is_integer($rule_values)? ((int)$rule_values>0? (int)$rule_values:1):0;
                                if (strlen($value) < $min) {
                                    $this->addError("`{$item}` should have minimum of `{$min}` caracters");
                                }
                                break;
                            case "max":
                                // check is the value entre is an integer
                                // and verifier if it is a possitive number
                                $max = is_integer($rule_values) ? ((int)$rule_values > 0 ? (int)$rule_values : 0):0;
                                if (strlen($value) > $max) {
                                    $this->addError("`{$item}` should have maximum of `{$max}` caracters");
                                }
                                break;
                            case "number":
                                if (preg_match("#.\W#", $value) || preg_match("#[a-zA-Z]#", $value)) {
                                    $this->addError("`{$item}` should be a number");
                                }
                                break;
                            case "positive":
                                if ($value<1) {
                                    $this->addError("`{$item}` should be a positive number");
                                }
                                break;
                            case "email":
                                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                                    $this->addError("`{$item}` this should be an email");
                                }
                                break;
                            case "url":
                                if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $value)) {
                                    $this->addError("`{$item}` this shoudl be a link(url)");
                                }
                                break;
                            case "matches":
                                if ($value !== $source[$rule_values]) {
                                    $this->addError("`{$rule_values}` should me the same as `{$item}`");
                                }
                                break;
                            default:
                                if($rule != 'required'){
                                    $this->addError("rule `{$rule}` is not defined");
                                }
                                break;
                        }
                    }
                }else{
                    $this->addError("`{$item}` does not exist");
                }
            }
        }
        if (count($this->_errors) == 0) {
            $this->_passed = true;
        }
    }
    private function addError(string $value){
        $this->_errors[]=$value;
    }
    /**
     * 
     * @returns array
     */
    function errors(){
        return $this->_errors;
    }
    /**
     * 
     * @returns boolean [true,false]
     */
    function passed(){
        return $this->_passed;
    }
}