<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Schema;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Wepesi\App\Providers\SChemaProvider;

/**
 * Description of String
 *
 * @author Domeshow
 */
abstract class BooleanSchema extends SChemaProvider
{

    function __construct()
    {
        parent::__construct("BooleanValidator");
    }

    function isValid(): BooleanSchema
    {
        $this->schema[$this->source]['isValid'] = true;
        return $this;
    }
}
