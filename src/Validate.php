<?php

namespace Wepesi\App;
/**
 * Description of validate
 *
 * @author Boss Ibrahim Mussa
 */
class Validate {
    private bool $_passed;
    private array $_errors;
    private array $source;

    /**
     * 
     * @param array $_source
     */
    function __construct(array $_source) {
        $this->_errors=[];
        $this->_passed = false;
        $this->source=$_source;
    }

    /**
     * this module help to check if there are define module but does not be defined to be checked
     * @param $source
     * @param array $items
     */
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
                    "type" => "object.unknown",
                    "message" => i18n::translate("`%s` does not exist",[$item]),
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
    private function check_undefined_Object_key(array $source,array $items): bool
    {
        $diff_array_key= array_diff_key($source,$items);
        $source_key= array_keys($diff_array_key);
        $status_key=false;
        if(count($source_key)>0){
            foreach($source_key as $key){
                $message=[
                    "type" => "object.undefined",
                    "message" => i18n::translate("`%s` is not defined",[$key]),
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
    function string(string $tring_key=null): VString
    {
        return new VString($this->source,$tring_key);
    }

    /**
     *
     * @param string|null $string_key
     * @return VNumber
     */
    function number(string $string_key=null): VNumber
    {
        return new VNumber($this->source,$string_key);
    }

    /**
     * @param string|null $string_key
     * @return bool
     */
    function any(string $string_key=null){
        return $this->check_undefined_Object_key($this->source,[$string_key]);
    }

    /**
     * @param string|null $string_key
     * @return VDate
     */
    function date(string $string_key=null): VDate
    {
        return new VDate($this->source,$string_key);
    }

    /**
     *
     * @param string|null $tring_key
     * @return VBoolean
     */
    function boolean(string $tring_key=null): VBoolean
    {
        return new VBoolean($this->source,$tring_key,$this->source[$tring_key]);
    }
    /**
     * 
     * @param array $value
     * @return void
     */
    private function addError(array $value): void
    {
        $this->_errors[] = $value;
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
    function passed(): bool
    {
        return $this->_passed;
    }
}
