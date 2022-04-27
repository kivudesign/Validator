<?php

/**
 * Description of validate
 *
 * @author Boss Ibrahim Mussa
 */
namespace Wepesi\App;

use Wepesi\App\Schema\BooleanSchema;
use Wepesi\App\Schema\DateSchema;
use Wepesi\App\Schema\NumberSchema;
use Wepesi\App\Schema\StringSchema;

class Validate
{
    private array $errors;
    private bool $passed;
    private array $resource;

    function __construct()
    {
        $this->errors=[];
        $this->passed=false;
        $this->resource=[];
    }

    function check(array $source,array $schema){
        $this->errors = [];
        $this->check_undefined_Object_key($source, $schema);
        foreach ($schema as $item => $response) {
            if (isset($source[$item])) {
                if ($response) {
                    foreach ($response as $key => $value) {
                        $this->addError($value);
                    }
                }
            } else {
                $message = [
                    'type' => 'object.unknown',
                    'message' => "`$item` does not exist",
                    'label' => $item,
                ];
                $this->addError($message);
            }
        }
        if (count($this->errors) == 0) {
            $this->passed = true;
        }
    }
    function any(){

    }

    private function check_undefined_Object_key($source,$items){
        $diff_array_key = array_diff_key($source, $items);
        $source_key = array_keys($diff_array_key);
        if (count($source_key) > 0) {
            foreach ($source_key as $key) {
                $message = [
                    'type' => 'object.undefined',
                    'message' => "`$key` is not defined",
                    'label' => $key
                ];
                $this->addError($message);
            }
        }
    }

    private function addError(array $message){
        $this->errors[]=$message;
    }
    /**
     * @return StringSchema
     */
    function string(): StringSchema
    {
        return new StringSchema();
    }

    /**
     * @return NumberSchema
     */
    function number(): NumberSchema
    {
        return new NumberSchema();
    }

    /**
     * @return DateSchema
     */
    function date(): DateSchema
    {
        return new DateSchema();
    }

    function boolean(): BooleanSchema
    {
        return new BooleanSchema();
    }

    /**
     * @return array
     */
    function errors(): array
    {
        return $this->errors;
    }
    /**
     * @return bool
     */
    function passed(): bool
    {
        return $this->passed;
    }
}