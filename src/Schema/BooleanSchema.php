<?php

namespace Wepesi\App\Schema;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of String
 *
 * @author Domeshow
 */
class BooleanSchema
{
    private string $source;
    private array $schema;

    function __construct()
    {
        $this->source = "VBolean";
        $this->schema[$this->source]=[];
    }

    function isValid(): BooleanSchema
    {
        $this->schema[$this->source]['isValid']=true;
        return $this;
    }

    function required(): SChema
    {
        $this->schema[$this->source]['required'] = true;
        
        return $this;
    }

    function check(): array
    {
        return $this->schema;
    }
}
