<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Validator;

use Wepesi\App\Providers\ValidatorProvider;
use Wepesi\App\Validate;

final class ArrayValidator extends ValidatorProvider
{
    /**
     * @param string $item field name
     * @param array $data_source resource where data will come from
     */
    public function __construct(string $item, array $data_source=[])
    {
        $this->errors = [];
        $this->data_source = $data_source;
        $this->field_name = $item;
        $this->field_value = $data_source[$item];
        $this->class_provider = "array";
        parent::__construct();
    }

    /**
     * check the minimum length of an array should be about
     * @param int $rule
     * @return void
     */
    public function min(int $rule):void
    {
        // TODO: Implement min() method.
        if($this->positiveParamMethod($rule)) return;
        if (count($this->field_value) < $rule) {
            $message = [
                'type' => 'array.min',
                'message' => "`$this->field_name` should have a minimum of `$rule` elements",
                'label' => $this->field_name,
                'limit' => $rule
            ];
            $this->addError($message);
        }
    }

    public function max(int $rule):void
    {
        // TODO: Implement max() method.
        if($this->positiveParamMethod($rule,true)) return;
        if (count($this->field_value) > $rule) {
            $message = [
                'type' => 'array.max',
                'message' => "`$this->field_name` should have a maximum of `$rule` elements",
                'label' => $this->field_name,
                'limit' => $rule
            ];
            $this->addError($message);
        }
    }

    /**
     * @param array $elements validate an array if elements, it should be and array with key value to be well set
     * @return void
     */
    public function structure(array $elements):void
    {
        $validate = new Validate();
        $element_source = $this->data_source[$this->field_name];
        $validate->check($element_source,$elements);
        if(!$validate->passed()){
            foreach ($validate->errors() as $error) $this->addError($error);
        }
    }

    /**
     * check content are string, in other case handler an error
     * @return void
     */
    public function string():void
    {
        $len = count($this->field_value);
        if ($len < 1) {
            $this->min(1);
        }else{
            $filter = array_filter($this->field_value,function($element){
                if(!is_string($element)) return $element;
            });
            $keys = array_keys($filter);
            for($i=0; $i<count($keys); $i++){
                $position = $keys[$i];
                $message = [
                    'type' => 'array.string',
                    'message' => "`$this->field_name[$position]` should be a string",
                    'label' => $this->field_name,
                    'limit' => 1
                ];
                $this->addError($message);
            }
        }
    }

    /**
     * @return void
     */
    public function number():void
    {
        $len = count($this->field_value);
        if ($len < 1) {
            $this->min(1);
        }else{
            $filter = array_filter($this->field_value,function ($element){
                if(!is_numeric($element)) return $element;
            });

            $keys = array_keys($filter);
            for($i=0; $i<count($keys); $i++){
                $position = $keys[$i];
                $message = [
                    'type' => 'array.number',
                    'message' => "`$this->field_name[$position]` should be a number",
                    'label' => $this->field_name,
                    'limit' => count($keys)
                ];
                $this->addError($message);
            }
        }
    }
}