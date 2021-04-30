<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Wepesi\app;
use Exception;
/**
 * Description of tst_valisate
 *
 * @author Lenovo
 */
class Validate {
    private $_passed;
    private $_errors;
    private $stringValue;
    private $source;
    private $query;
    //put your code here
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
    private function check_undefined_Object_key(array $source,array $items){
        $diff_array_key= array_diff_key($source,$items);
        $source_key= array_keys($diff_array_key);
        
//        $len=count($source_key);
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
    function string(string $tring_key=null){
        try{
            $regex="#[a-zA-Z0-9]#";
            if(!isset($this->source[$tring_key]) ){
                throw new Exception("this key does not exist");
            }
            if(isset($this->source[$tring_key]) && preg_match($regex,$this->source[$tring_key]) && strlen($this->source[$tring_key])>0){
               $this->query=new VString($this->source,$tring_key,$this->source[$tring_key]);   
               return $this->query;            
            }else{
                $message=[
                    "type" => "string.unknow",
                    "message" => "`{$tring_key}` shoud be a s tring",
                    "label" => $tring_key,
                ];
                $this->addError($message);
                return false;
            }        
        } catch (Exception $ex){
            return $ex->getMessage();
        }
    }
    private function addError(array $value){
       return $this->_errors[]=$value;
    }
    
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
