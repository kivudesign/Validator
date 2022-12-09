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
 * @author Boss Ibrahim Mussa
 */
abstract class StringSchema extends SChemaProvider {

    function __construct() {
        parent::__construct('StringValidator');
    }

    function email(): StringSchema
    {
        $this->schema[$this->source]["email"]=true;
        return $this;
    }
    /**
     * 
     * @return $this
     */
    function url(): StringSchema
    {
        $this->schema[$this->source]["url"]=true;
        return $this;
    }

    /**
     *
     * @param string $key_to_match
     * @return $this
     */
    function match(string $key_to_match): StringSchema
    {
        $this->schema[$this->source]["match"]=$key_to_match;
        return $this;
    }
}