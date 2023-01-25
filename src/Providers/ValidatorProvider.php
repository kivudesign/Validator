<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Providers;


use Wepesi\App\Providers\Contracts\Contracts;

abstract class ValidatorProvider implements Contracts
{
    protected array $errors;
    protected array $data_source;
    protected string $field_name;
    protected $field_value;
    protected string $class_provider = 'unknown';
    function __construct(){
        $this->errors = [];
    }
    abstract public function min(int $rule);
    abstract public function max(int $rule);
    public function required(){
        if(is_array($this->field_value)){
            if (count($this->field_value) == 0) {
                $message = [
                    'type' => $this->class_provider . ' required',
                    'message' => "'$this->field_name' is required",
                    'label' => $this->field_name,
                ];
                $this->addError($message);
            }
        }else{
            $required_value = trim($this->field_value);
            if (strlen($required_value) == 0) {
                $message = [
                    'type' => $this->class_provider . ' required',
                    'message' => "'$this->field_name' is required",
                    'label' => $this->field_name,
                ];
                $this->addError($message);
            }
        }
    }
    /**
     *
     * @param array $value
     * @return void
     */
    public function addError(array $value): void
    {
        $this->errors[] = $value;
    }

    /**
     * @return array
     */
    public function result(): array
    {
        return  $this->errors;
    }

    protected function positiveParamMethod(int $rule,bool $max = false):bool{
        $status = true;
        if($rule<1){
            $method = $max?"max":"min";
            $message = [
                'type' => $this->class_provider . ' method '. $method,
                'message' => "'$this->field_name' $method param should be a positive number",
                'label' => $this->field_name,
            ];
            $this->addError($message);
            $status = false;
        }
        return $status;
    }
}