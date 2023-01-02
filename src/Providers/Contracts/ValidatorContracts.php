<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Providers\Contracts;


interface ValidatorContracts extends Contracts
{
    public function addError(array $value);
    public function result():array;
}