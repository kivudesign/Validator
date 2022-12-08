<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Providers\Contracts;


interface ValidatorContracts extends Contracts
{
    function addError(array $value);
    function result():array;
}