<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Wepesi\App\Schema;

use Wepesi\App\Providers\SChemaProvider;

/**
 * Description of VNumber
 *
 * @author Boss Ibrahim Mussa
 */
class NumberSchema extends SChemaProvider {

    function __construct() {
        parent::__construct("Number");
    }

    /**
     * @return $this
     */
    function positive(): NumberSchema
    {
        $this->schema[$this->source]['positive']=true;
        return $this;
    }
}
