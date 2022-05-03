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

    /**
     * @return array
     */
    function result(): ?array
    {
        return  $this->errors;
    }
}