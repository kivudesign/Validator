<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Traits;


trait ExceptionTraits
{

    protected function exception($ex): array
    {
        return ['exception' => $ex->getMessage()];
    }
}