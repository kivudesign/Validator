<?php

namespace Wepesi\App\Providers;

use Wepesi\App\Providers\Contracts\SchemaContracts;

abstract class SChemaProvider implements SchemaContracts
{
    protected array $schema=[];
    protected string $source;

    /**
     * @param $rule
     * @return SChemaProvider
     *
     */
    function min($rule): SChemaProvider
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
    function check(): array
    {
        return  $this->schema;
    }
}