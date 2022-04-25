<?php
//
//
//namespace Wepesi\App;
///**
// * Description of VDate
// *
// * @author Boss Ibrahim Mussa
// */
//class VDate
//{
//    private $date_value;
//    private ?string $string_item;
//    private array $source_data;
//    private array $_errors=[];
//    private int $_min;
//    private int $_max;
//    //put your code here
//    private i18n $i18n;
//
//    function __construct(array $source,string $string_item=null,string $lang="en") {
//        $this->date_value=$source[$string_item];
//        $this->string_item=$string_item;
//        $this->source_data=$source;
//        $this->i18n= new i18n($lang);
//        $this->_max= $this->_min=0;
//        $this->checkExist();
//    }
//
//    /**
//     * @return $this
//     */
//    function now(): SCHDate
//    {
//        $min_date_time=strtotime("now");
//        $min_date=date("d/F/Y",$min_date_time);
//        $date_value_time= strtotime($this->date_value);
//        if ($date_value_time < $min_date_time) {
//            $message=[
//                "type"=>"date.now",
//                "message"=> $this->i18n->translate("`%s` should be greater than now",[$this->string_item]),
//                "label"=>$this->string_item,
//                "limit"=>$min_date
//            ];
//            $this->addError($message);
//        }
//        return $this;
//    }
//
//    /**
//     * @param string|null $times
//     * @return $this
//     * while trying to get day validation use this module
//     */
//    function today(string $times=null): SCHDate
//    {
//        $min_date_time=strtotime("now {$times}");
//        $min_date=date("d/F/Y",$min_date_time);
//        $date_value_time= strtotime($this->date_value);
//        if ($date_value_time > $min_date_time) {
//            $message=[
//                "type"=>"date.now",
//                "message"=> $this->i18n->translate("`%s` should be greater than today ",[$this->string_item]),
//                "label"=>$this->string_item,
//                "limit"=>$min_date
//            ];
//            $this->addError($message);
//        }
//        return $this;
//    }
//
//    /**
//     * @param string|null $rule_values
//     * @return $this
//     * get the min date control from the given date
//     */
//    function min(string $rule_values=null): SCHDate
//    {
//        /**
//         * $regex= "#[a-zA-Z]#";
//         * $time= preg_match($regex,$rule_values);
//         * $con=!$time?$time:(int)$time;
//         * in case the parameters are integers
//         */
//        $rule_values= $rule_values ?? "now";
//        $min_date_time=strtotime($rule_values);
//        $min_date=date("d/F/Y",$min_date_time);
//        $date_value_time= strtotime($this->date_value);
//        if ($date_value_time > $min_date_time) {
//            $message=[
//                "type"=>"date.min",
//                "message"=> $this->i18n->translate("`%s` should be greater than `%s`",[$this->string_item,$min_date]),
//                "label"=>$this->string_item,
//                "limit"=>$min_date
//            ];
//            $this->addError($message);
//        }
//        return $this;
//    }
//
//    /**
//     * @param string|null $rule_values
//     * @return $this
//     * while try to check maximum date of a defined period use this module
//     */
//    function max(string $rule_values=null): SCHDate
//    {
//        $rule_values= $rule_values ?? "now";
//        $max_date_time=strtotime($rule_values);
//        $max_date=date("d/F/Y",$max_date_time);
//        $date_value_time= strtotime($this->date_value);
//        if ($max_date_time<$date_value_time) {
//            $message = [
//                "type" => "date.max",
//                "message" => $this->i18n->translate("`%s` should be less than `%s`",[$this->string_item,$max_date]),
//                "label" => $this->string_item,
//                "limit" => $max_date
//            ];
//            $this->addError($message);
//        }
//        return $this;
//    }
//    /**
//     * @return $this
//     * call this module is the input is requied and should not be null or empty
//     */
//    function required(): SCHDate
//    {
//        $required_value= trim($this->date_value);
//        if (empty($required_value) || strlen($required_value)==0) {
//            $message = [
//                "type"=> "any.required",
//                "message" => $this->i18n->translate("`%s` is required",[$this->string_item]),
//                "label" => $this->string_item,
//            ];
//            $this->addError($message);
//        }
//        return $this;
//    }
////    private methode
//    private function checkExist(string $itemKey=null): void
//    {
//        $item_to_check=$itemKey?$itemKey:$this->string_item;
//        $regex="#[a-zA-Z0-9]#";
//        $this->_errors=[];
//        if (!isset($this->source_data[$item_to_check])) {
//            $message = [
//                "type"=> "any.unknown",
//                "message" => $this->i18n->translate("`%s` is unknown",[$item_to_check]),
//                "label" => $item_to_check,
//            ];
//            $this->addError($message);
//        }else if(!preg_match($regex,$this->source_data[$item_to_check]) || strlen(trim($this->source_data[$item_to_check]))==0){
//            $message=[
//                "type" => "date.unknown",
//                "message" => $this->i18n->translate("`%s` should be a date.",[$item_to_check]),
//                "label" => $item_to_check,
//            ];
//            $this->addError($message);
//        }
//    }
//    private function addError(array $value): void
//    {
//        $this->_errors[] = $value;
//    }
//    function check(): array
//    {
//        return  $this->_errors;
//    }
//}