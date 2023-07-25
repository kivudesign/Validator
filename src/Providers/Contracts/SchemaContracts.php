<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Providers\Contracts;


/**
 *
 */
interface SchemaContracts extends Contracts
{

    /**
     * @return mixed
     */
    public function generate();
}