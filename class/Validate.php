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
            foreach($rules as $rule=>$values){
                // check if the item existe on the source array $_array_name[$item]
                if(isset($source[$item])){
                    $value = trim($source[$item]);
                    // if the rele defined is required
                    if ($rule == 'required' && empty($value)) {
                        array_push($this->_errors, "{$item} is reuired");
                    }
                }else{
                    array_push($this->_errors,"{$item} does not exist");
                }
            }
        }
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