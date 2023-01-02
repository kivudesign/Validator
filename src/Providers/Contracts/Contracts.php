<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Providers\Contracts;


interface Contracts
{
    public function min(int $rule);
    public function max(int $rule);
    public function required();
}