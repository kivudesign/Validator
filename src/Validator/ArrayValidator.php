<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Validator;

use Wepesi\App\Providers\ValidatorProvider;
use Wepesi\App\Resolver\Option;
use Wepesi\App\Resolver\OptionsResolver;
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

    public function min(int $rule)
    {
        // TODO: Implement min() method.
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

    public function max(int $rule)
    {
        // TODO: Implement max() method.
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
    public function elements(array $elements){
        $validate = new Validate();
        $element_source = $this->data_source[$this->field_name];
        $validate->check($element_source,$elements);
        if(!$validate->passed()){
            foreach ($validate->errors() as $error) $this->addError($error);
        }
    }

    public function string(){
        $message = [
            'type' => 'array.string',
            'message' => "`$this->field_name` should have at least 1 elements",
            'label' => $this->field_name,
            'limit' => 1
        ];
        $len = count($this->field_value);
        if ($len < 1) {
            $this->addError($message);
        }else{
            for($i=0; $i<$len; $i++){
                if(!is_string($this->field_value[$i])){
                    $message['message'] = "`$this->field_name[$i]` should be a string";
                    $this->addError($message);
                }
            }
        }
    }
}