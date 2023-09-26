<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Providers;

use Wepesi\App\Providers\Contracts\SchemaContracts;

/**
 *
 */
abstract class SchemaProvider implements SchemaContracts
{
    /**
     * @var array
     */
    protected array $schema = [];
    /**
     * @var string
     */
    protected string $class_name;

    /**
     * @param int $rule
     * @return SchemaProvider
     */
    public function min(int $rule): SchemaProvider
    {
        $this->schema["min"] = $rule;
        return $this;
    }

    /**
     * @param $rule
     * @return $this
     */
    public function max($rule): SchemaProvider
    {
        $this->schema["max"] = $rule;
        return $this;
    }

    /**
     * @return $this
     */
    public function required(): SchemaProvider
    {
        $this->schema["required"] = true;
        return $this;
    }

    /**
     * @return array
     */
    public function generate(): array
    {
        $reflexion = new \ReflectionClass($this);
        return [$reflexion->getName() => $this->schema];
    }

    public function __call($method, $args){
        if(method_exists($this,$method)){
            return call_user_func_array([$this,$method], $args);
        }
    }
}