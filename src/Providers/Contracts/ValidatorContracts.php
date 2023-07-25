<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Providers\Contracts;


/**
 *
 */
interface ValidatorContracts extends Contracts
{
    /**
     * @param array $value
     * @return mixed
     */
    public function addError(array $value);

    /**
     * @return array
     */
    public function result(): array;
}