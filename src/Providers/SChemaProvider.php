<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Providers;

use Wepesi\App\Providers\Contracts\SchemaContracts;

abstract class SChemaProvider implements SchemaContracts
{
    protected array $schema = [];
    protected string $source;

    function __construct(string $type)
    {
        $this->source = $type;
        $this->schema[$this->source] = [];
    }

    /**
     * @param int $rule
     * @return SChemaProvider
     */
    function min(int $rule): SChemaProvider
    {
        $this->schema[$this->source]["min"]=$rule;
        return $this;
    }

    /**
     * @param $rule
     * @return $this
     */
    function max($rule): SChemaProvider
    {
        $this->schema[$this->source]["max"]=$rule;
        return $this;
    }

    function required(): SChemaProvider
    {
        $this->schema[$this->source]["required"]=true;
        return $this;
    }

    /**
     * @return array
     */
    function generate(): array
    {
        return  $this->schema;
    }
}