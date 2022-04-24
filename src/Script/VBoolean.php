<?php
//
//namespace Wepesi\App;
///*
// * To change this license header, choose License Headers in Project Properties.
// * To change this template file, choose Tools | Templates
// * and open the template in the editor.
// */
//
///**
// * Description of String
// *
// * @author Domeshow
// */
//class VBoolean
//{
//    private $string_value;
//    private ?string $string_item;
//    private array $source_data;
//    private array $_errors=[];
//    private i18n $i18n;
//
//    /**
//     *
//     * @param array $source
//     * @param string|null $string_item
//     */
//    function __construct(array $source, string $string_item = null,string $lang)
//    {
//        $this->string_item = $string_item;
//        $this->source_data = $source;
//        $this->i18n= new i18n($lang);
//        if ($this->checkExist()) {
//            $this->string_value = $source[$string_item];
//        };
//    }
//
//    /**
//     *
//     * @param string|null $itemKey
//     * @return boolean
//     */
//    private function checkExist(string $itemKey = null): bool
//    {
//        $item_to_check = !$itemKey ? $this->string_item:$itemKey ;
//        $val = $this->source_data[$item_to_check];
//
//        $regex = "/^(true|false)$/";
//        if (!isset($this->source_data[$item_to_check])) {
//            $message = [
//                "type" => "any.unknown",
//                "message" => $this->i18n->translate("`%s` is unknown",[$item_to_check]),
//                "label" => $item_to_check,
//            ];
//            $this->addError($message);
//            return false;
//        } else if (!preg_match($regex, is_bool($val) ? ($val ? 'true' : 'false') : $val)) {
//            $message = [
//                "type" => "boolean.unknown",
//                "message" => $this->i18n->translate("`%s` should be a boolean",[$item_to_check]),
//                "label" => $item_to_check,
//            ];
//            $this->addError($message);
//            return false;
//        }
//        return true;
//    }
//
//    function required(): SCHBoolean
//    {
//        $required_value = is_bool($this->string_value);
//        if (empty($required_value)) {
//            $message = [
//                "type" => "any.required",
//                "message" => $this->i18n->translate("`%s` is required",[$this->string_item]),
//                "label" => $this->string_item,
//            ];
//            $this->addError($message);
//        }
//        return $this;
//    }
//
//    function isValid(string $value): SCHBoolean
//    {
//        $passed_value = is_bool($value) ? ($value ? 'true' : 'false') : $value;
//        $required_value = strtolower($passed_value);
//        $check = $required_value == 'true' || $required_value == 'false';
//        if (!($check)) {
//            $message = [
//                "type" => "boolean.required",
//                "message" => $this->i18n->translate("isValid param must be boolean but you put `%s`",[$required_value]),
//                "label" => $this->string_item,
//            ];
//            $this->addError($message);
//        } else {
//            // $sting_value= is_bool($this->string_value);
//            $incoming_value =  $this->string_value ? 'true' : 'false';
//
//            if ($incoming_value != $required_value) {
//                $message = [
//                    "type" => "boolean.valid",
//                    "message" => $this->i18n->translate("`%s` is not validValue required. You must put `%s`",[$incoming_value,$required_value]),
//                    "label" => $this->string_item,
//                ];
//                $this->addError($message);
//            }
//        }
//        return $this;
//    }
//
//    /**
//     *
//     * @param array $value
//     * @return void
//     */
//    private function addError(array $value): void
//    {
//        $this->_errors[] = $value;
//    }
//
//    /**
//     * @return array
//     */
//    function check(): array
//    {
//        return  $this->_errors;
//    }
//}
