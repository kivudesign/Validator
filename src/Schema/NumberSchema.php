<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Wepesi\App\Schema;

/**
 * Description of VNumber
 *
 * @author Boss Ibrahim Mussa
 */
class NumberSchema extends SChema {

    function __construct() {
        $this->source="VNumber";
        $this->schema[$this->source]=[];
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
