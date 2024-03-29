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

use Wepesi\App\Providers\SchemaProvider;

/**
 * Description of String
 *
 * @author Domeshow
 */
final class BooleanSchema extends SchemaProvider
{
    /**
     * @return $this
     */
    function isValid(): BooleanSchema
    {
        $this->schema['isValid'] = true;
        return $this;
    }
}
