<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Wepesi\App;

/**
 * Description of VNumber
 *
 * @author Boss Ibrahim Mussa
 */
class VNumber {
    //put your code here
    private $string_value;
    private string $string_item;
    private array $source_data;
    private array $_errors;
    private int $_min;
    private int $_max;
    private i18n $i18n;

    function __construct(array $source,string $string_item,string $lang="en") {
        $this->source_data=$source;        
        $this->string_item=$string_item;
        $this->_max= $this->_min=0;
        $this->i18n= new i18n($lang);
        if($this->checkExist()){
            $this->string_value=$source[$string_item];
        }
    }

    /**
     * @param int $min_values
     * @return $this
     */
    function min(int $min_values): VNumber
    {
        if ((int) $this->string_value < $min_values) {
            $message=[
                "type"=>"number.min",
                "message"=> $this->i18n->translate("`%s` should be greater than `%s`",[$this->string_item,$min_values]),
                "label"=>$this->string_item,
                "limit"=>$min_values
            ];
            $this->addError($message);
        }
        return $this;
    }

    /**
     * @param int $min_values
     * @return $this
     */
    function max(int $min_values): VNumber
    {
        if ((int) $this->string_value > $min_values) {
            $message=[
                "type"=>"number.max",
                "message"=> $this->i18n->translate("`%s` should be less than `%s`",[$this->string_item,$min_values]),
                "label"=>$this->string_item,
                "limit"=>$min_values
            ];
            $this->addError($message);
        }
        return $this;
    }

    /**
     * @param int $min_values
     * @return $this
     */
    function positive(int $min_values): VNumber
    {
        if ((int) $this->string_value < 0) {
            $message=[
                "type"=>"number.positive",
                "message"=> $this->i18n->translate("`%s` should be a positive number",[$this->string_item]),
                "label"=>$this->string_item,
                "limit"=>1
            ];
            $this->addError($message);
        }
        return $this;
    }

    /**
     * @return $this
     */
    function required(): VNumber
    {
        $required_value= trim($this->string_value);
        if (empty($required_value)) {
            $message = [
                "type"=> "any.required",
                "message" => $this->i18n->translate("`%s` is required",[$this->string_item]),
                "label" => $this->string_item,
            ];
            $this->addError($message);
        }
        return $this;
    }

    /**
     * @param string|null $itemKey
     * @return bool
     */
    private function checkExist(string $itemKey=null): bool
    {
        $item_to_check=!$itemKey?$this->string_item:$itemKey;
        $regex_string="#[a-zA-Z]#";
        $status_key_exist=true;
        if (!isset($this->source_data[$item_to_check])) {
            $message = [
                "type"=> "any.unknown",
                "message" => $this->i18n->translate("`%s` is unknown",[$item_to_check]),
                "label" => $item_to_check,
            ];
            $this->addError($message);
            $status_key_exist=false;
        }else if (preg_match($regex_string,trim($this->source_data[$item_to_check])) || !is_integer($this->source_data[$item_to_check])) {            
            $message = [
                "type"=> "number.unknown",
                "message" => $this->i18n->translate("`%s` should be a number",[$item_to_check]),
                "label" => $item_to_check,
            ];
            $this->addError($message);
            $status_key_exist=false;
        }
        return $status_key_exist;
    }

    /**
     * @param array $value
     */
    private function addError(array $value): void
    {
        $this->_errors[] = $value;
    }

    /**
     * @return array
     */
    function check(): array
    {
        return  $this->_errors;
    }
}
