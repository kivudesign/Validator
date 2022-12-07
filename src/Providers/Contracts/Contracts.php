<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Providers\Contracts;


interface Contracts
{
    function min(int $rule);
    function max(int $rule);
}