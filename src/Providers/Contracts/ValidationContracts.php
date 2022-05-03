<?php


namespace Wepesi\App\Providers\Contracts;


interface ValidationContracts extends Contracts
{
    function required();
    function addError(array $value);
    function result();
}