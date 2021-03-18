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
                    $value = $source[$item];
                    // if the rele defined is required
                    if ($rule == 'required' && empty($value)&& $value != 0) {
                        $message = [
                            "type"=> "any.required",
                            "message" => "`{$item}` is required",
                            "label" => $item,
                        ];
                        $this->addError($message);
                    }else if(!empty($value) || $value == 0){
                        switch($rule){
                            // check for minimu input lenght of a string
                            case "min":
                                // check is the value entre is an integer
                                // and verifier if it is a possitive number, in order to check the minimum length
                                $min=is_integer($rule_values)? ((int)$rule_values>0? (int)$rule_values:1):0;
                                if (strlen($value) < $min) {
                                    $message=[
                                        "type"=>"string.min",
                                        "message"=> "`{$item}` should have minimum of `{$min}` caracters",
                                        "label"=>$item,
                                        "limit"=>$min
                                    ];
                                    $this->addError($message);
                                }
                                break;
                            case "max":
                                // check is the value entre is an integer
                                // and verifier if it is a possitive number
                                $max = is_integer($rule_values) ? ((int)$rule_values > 0 ? (int)$rule_values : 0):0;
                                if (strlen($value) > $max) {
                                    $message = [
                                        "type" => "string.max",
                                        "message" => "`{$item}` should have maximum of `{$max}` caracters",
                                        "label" => $item,
                                        "limit" => $max
                                    ];
                                    $this->addError($message);
                                }
                                break;
                            case "number":
                                if (preg_match("#.\W#", $value) || preg_match("#[a-zA-Z]#", $value)) {
                                    $message = [
                                        "type" => "number.base",
                                        "message" => "`{$item}` should be a number",
                                        "label" => $item,
                                    ];
                                    $this->addError($message);
                                }
                                break;
                            case "positive":
                                if ($value<1) {
                                    $message = [
                                        "type" => "number.positive",
                                        "message" => "`{$item}` should be a positive number",
                                        "label" => $item,
                                    ];
                                    $this->addError($message);
                                }
                                break;
                            case "email":
                                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                                    $message = [
                                        "type" => "string.email",
                                        "message" => "`{$item}` this should be an email",
                                        "label" => $item,
                                    ];
                                    $this->addError($message);
                                }
                                break;
                            case "url":
                                if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $value)) {
                                    $message = [
                                        "type" => "string.url",
                                        "message" => "`{$item}` this shoudl be a link(url)",
                                        "label" => $item,
                                    ];
                                    $this->addError($message);
                                }
                                break;
                            case "matches":
                                if(!isset($source[$rule_values])){
                                    $message = [
                                        "type" => "number.base",
                                        "message" => "`{$item}` does not exist, to matches",
                                        "label" => $item,
                                    ];
                                    $this->addError($message);
                                }else{
                                    if ($value !== $source[$rule_values]) {
                                        $message = [
                                        "type" => "string.match",
                                        "message" => "`{$rule_values}` should me the same as `{$item}`",
                                        "label_1" => $rule_values,
                                        "label_2" => $item,
                                    ];
                                        $this->addError($message);
                                    }
                                }
                                break;
                            case "boolean":
                                
                                if(!is_bool($value))
                                {     
                                    if((!is_integer($value)) || ($value < 0 && $value > 1))
                                    {
                                        $message = [
                                            "type" => "boolean.base",
                                            "message" => "`{$item}` must be a boolean value",
                                            "label" => $item,
                                        ];
                                        $this->addError($message);

                                    }
                                }                                
                                break;
                            default:
                                if($rule != 'required'){
                                    $message = [
                                        "type" => "any.defined",
                                        "message" => "rule `{$rule}` is not defined",
                                        "label" => $item,
                                    ];
                                    $this->addError($message);
                                }
                                break;
                        }
                    }
                }else{
                    $message = [
                        "type" => "object.unknow",
                        "message" => "`{$item}` does not exist",
                        "label" => $item,
                    ];
                    $this->addError($message);
                }
            }
        }
        if (count($this->_errors) == 0) {
            $this->_passed = true;
        }
    }
    private function addError(array $value){
       $this->_errors[]=$value;
    }
    /**
     * 
     * @returns array
     */
    function errors(){
        return ["error"=>$this->_errors];
    }
    /**
     * 
     * @returns boolean [true,false]
     */
    function passed(){
        return $this->_passed;
    }
}