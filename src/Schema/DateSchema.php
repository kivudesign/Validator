<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Schema;

use Wepesi\App\Providers\SchemaProvider;

/**
 * Schema datetime
 *
 */
final class DateSchema extends SchemaProvider
{

    /**
     * @param string $rule
     * @return DateSchema
     */
    public function min($rule): DateSchema
    {
        $this->schema['min'] = $rule;
        return $this;
    }

    /**
     * @param string $rule
     * @return $this
     */
    public function max($rule): DateSchema
    {
        $this->schema['max'] = $rule;
        return $this;
    }

    /**
     * @return $this
     */
    function now(): DateSchema
    {
        $this->schema["now"] = true;
        return $this;
    }

    /**
     * @return $this
     */
    function today(): DateSchema
    {
        $this->schema["today"] = true;
        return $this;
    }
}