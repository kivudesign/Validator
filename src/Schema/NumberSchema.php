<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Schema;

use Wepesi\App\Providers\SChemaProvider;

/**
 * Description of VNumber
 *
 * @author Boss Ibrahim Mussa
 */
abstract class NumberSchema extends SChemaProvider {

    function __construct() {
        parent::__construct(__CLASS__);
    }

    /**
     * @return $this
     */
    function positive(): NumberSchema
    {
        $this->schema[$this->class_name]['positive'] = true;
        return $this;
    }
}
