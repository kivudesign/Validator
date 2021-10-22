<?php

namespace Wepesi\app;
/**
 * Description of validate
 *
 * @author Boss Ibrahim Mussa
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
//        $this->check_undefined_Object_key($source,$items);
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
     * @return boolean
     */
    private function check_undefined_Object_key(array $source,array $items){
        $diff_array_key= array_diff_key($source,$items);
        $source_key= array_keys($diff_array_key);
        $status_key=false;
        if(count($source_key)>0){
            foreach($source_key as $key){
                $message=[
                    "type" => "object.undefined",
                    "message" => "`{$key}` is not defined",
                    "label" => $key,
                ];
                $this->addError($message);
                $status_key=true;
            }
        }
        return $status_key;
    }

    /**
     *
     * @param string|null $tring_key
     * @return VString
     */
    function string(string $tring_key=null){
        return new VString($this->source,$tring_key);
    }

    /**
     *
     * @param string|null $string_key
     * @return VNumber
     */
    function number(string $string_key=null){
        return new VNumber($this->source,$string_key);
    }
    /**
     * 
     * @param string $string_key
     * @return type
     */
    function any(string $string_key=null){
        return $this->check_undefined_Object_key($this->source,[$string_key]);
    }

    /**
     * @param string|null $string_key
     * @return VDate
     */
    function date(string $string_key=null){
        return new VDate($this->source,$string_key);
    }
    /**
     * 
     * @param string $tring_key
     * @return \Wepesi\app\VString
     */
    function boolean(string $tring_key=null){
        return new VBoolean($this->source,$tring_key,$this->source[$tring_key]);
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
