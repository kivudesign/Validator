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
                        $this->addError("{$item} is required");
                    }else if(!empty($value)){
                        switch($rule){
                            // check for minimu input lenght of a string
                            case "min":
                                if (strlen($value) < $rule_values) {
                                    $this->addError("{$item} should have minimum of {$rule_values} caracters");
                                }
                                break;
                        }
                    }
                }else{
                    $this->addError("{$item} does not exist");
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