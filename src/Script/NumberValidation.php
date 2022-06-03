<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Wepesi\App;

use Wepesi\App\Providers\ValidationProvider;

/**
 * Description of VNumber
 *
 * @author Boss Ibrahim Mussa
 */
class NumberValidation extends ValidationProvider {
    //put your code here
    private $number_value;
    private string $field_item;
    private array $source_data;
    private array $_errors;
    private int $_min;
    private int $_max;

    function __construct(array $source,string $string_item) {
        $this->source_data=$source;
        $this->field_item=$string_item;
        $this->_max= $this->_min=0;
        if($this->isNumber()){
            $this->number_value=$source[$string_item];
        }
    }

    /**
     * @param $rule
     * @return $this
     */
    function min($rule): NumberValidation
    {
        if ((int) $this->number_value < $rule) {
            $message=[
                "type"=>"number.min",
                "message"=> "`$this->field_item` should be greater than `$rule`",
                "label"=>$this->field_item,
                "limit"=>$rule
            ];
            $this->addError($message);
        }
        return $this;
    }

    /**
     * @param $rule
     * @return $this
     */
    function max($rule): NumberValidation
    {
        if ((int) $this->number_value > $rule) {
            $message=[
                "type"=>"number.max",
                "message"=> "`$this->field_item` should be less than `$rule`",
                "label"=>$this->field_item,
                "limit"=>$rule
            ];
            $this->addError($message);
        }
        return $this;
    }

    /**
     * @param int $min_values
     * @return $this
     */
    function positive(): NumberValidation
    {
        if ((int) $this->number_value < 0) {
            $message=[
                "type"=>"number.positive",
                "message"=> "`$this->field_item` should be a positive number",
                "label"=>$this->field_item,
                "limit"=>1
            ];
            $this->addError($message);
        }
        return $this;
    }

    /**
     * @return $this
     */
//    function required()
//    {
//        $this->isRequired("number",$this->field_item);
//        return $this;
//    }

    /**
     * @param string|null $itemKey
     * @return bool
     */
    private function isNumber(): bool
    {
        $regex_string="#[a-zA-Z]#";
       if (preg_match($regex_string,trim($this->source_data[$this->field_item])) || !is_integer($this->source_data[$this->field_item])) {
            $message = [
                "type"=> "number.unknown",
                "message" => "`$this->field_item` should be a number",
                "label" => $this->field_item,
            ];
            $this->addError($message);
            return false;
        }
        return true;
    }
    /**
     * @return array
     */
    function check(): array
    {
        return  $this->_errors;
    }
}
