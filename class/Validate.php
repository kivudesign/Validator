<?php

namespace Wepesi\app;
/**
 * Description of validate
 *
 * @author Lenovo
 */
class Validate {
    private $_passed;
    private $_errors;
    private $stringValue;
    private $source;
    private $query;
    /**
     * 
     * @param array $_source
     */
    function __construct(array $_source) {
        $this->_errors=[];
        $this->_passed = false;
        $this->source=$_source;
        $this->stringValue="";
    }
    /*
     * @array $source: from where to check
     * @array $items : model for validation
     * 
     * this module help to check if there are define module but does not be defined to be checked
     * 
     * */
    function check($source,array $items=[]){ 
        $this->check_undefined_Object_key($source,$items);
        foreach($items as $item=>$response){
            if(isset($source[$item])) {
                if($response){
                    foreach ($response as $key=>$value){
                        $this->addError($value);                    
                    }                    
                }
            }else{
                $message=[
                    "type" => "object.unknow",
                    "message" => "`{$item}` does not exist",
                    "label" => $item,
                ];
                $this->addError($message);
            }            
        }
        if (count($this->_errors) == 0) {
            $this->_passed = true;
        }
    }
    /**
     * 
     * @param array $source
     * @param array $items
     */
    private function check_undefined_Object_key(array $source,array $items){
        $diff_array_key= array_diff_key($source,$items);
        $source_key= array_keys($diff_array_key);
        if(count($source_key)>0){
            foreach($source_key as $key){
                $message=[
                    "type" => "object.undefined",
                    "message" => "`{$key}` is not defined",
                    "label" => $key,
                ];
                $this->addError($message);
            }
        }
    }
    /**
     * 
     * @param string $tring_key
     * @return \Wepesi\app\VString
     */
    function string(string $tring_key=null){
        return new VString($this->source,$tring_key,$this->source[$tring_key]);
    }
    /**
     * 
     * @param string $tring_key
     * @return \Wepesi\app\VNumber
     */
    function number(string $tring_key=null){
        return new VNumber($this->source,$tring_key,$this->source[$tring_key]);
    }
    /**
     * 
     * @param array $value
     * @return type
     */
    private function addError(array $value){
       return $this->_errors[]=$value;
    }
    /**
     * 
     * @return type
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
