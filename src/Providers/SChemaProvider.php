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
    protected string $class_name;

    /**
     * @param string $class_name
     */
    public function __construct(string $class_name)
    {
        $this->class_name = $class_name;
        $this->schema[$this->class_name] = [];
    }

    /**
     * @param int $rule
     * @return SChemaProvider
     */
    public function min(int $rule): SChemaProvider
    {
        $this->schema[$this->class_name]["min"] = $rule;
        return $this;
    }

    /**
     * @param $rule
     * @return $this
     */
    public function max($rule): SChemaProvider
    {
        $this->schema[$this->class_name]["max"] = $rule;
        return $this;
    }

    public function required(): SChemaProvider
    {
        $this->schema[$this->class_name]["required"] = true;
        return $this;
    }

    /**
     * @return array
     */
    public function generate(): array
    {
        return  $this->schema;
    }
}