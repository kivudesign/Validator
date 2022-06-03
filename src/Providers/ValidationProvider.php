<?php


namespace Wepesi\App\Providers;


use Wepesi\App\Providers\Contracts\Contracts;

abstract class ValidationProvider implements Contracts
{
    abstract function min($rule);
    abstract function max($rule);
    abstract function required();
    /**
     *
     * @param array $value
     * @return void
     */
    function addError(array $value): void
    {
        $this->errors[] = $value;
    }

    protected function isRequired(string $source="any",string $fields){
        $required_value = trim($fields);
        if (strlen($required_value) == 0) {
            $message = [
                'type' => $source.".required",
                'message' => "`$fields` is required",
                'label' => $fields,
            ];
            $this->addError($message);
        }
    }
    /**
     * @return array
     */
    function result(): ?array
    {
        return  $this->errors;
    }
}