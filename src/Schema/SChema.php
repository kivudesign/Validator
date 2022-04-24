<?php

namespace Wepesi\App\Schema;

abstract class SChema
{
    protected array $schema=[];
    protected string $source;

    /**
     * @param int $rule_values
     * @return SChema min date control from the given date
     * get the min date control from the given date
     */
    function min(int $rule_values): SChema
    {
        $this->schema[$this->source]["minimum"]=$rule_values;
        return $this;
    }

    /**
     * @param int $rule_values
     * @return DateSchema try to check maximum date of a defined period use this module
     * while try to check maximum date of a defined period use this module
     */
    function max(int $rule_values): SChema
    {
        $this->schema[$this->source]["maximum"]=$rule_values;
        return $this;
    }

    function required(): SChema
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