<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Schema;
use Wepesi\App\Providers\SChemaProvider;

/**
 * Description of VDate
 *
 * @author Boss Ibrahim Mussa
 */
abstract class DateSchema extends SChemaProvider
{
    function __construct() {
        parent::__construct('DateValidator');
    }

    /**
     * @param string $rule
     * @return DateSchema
     */
    public function min($rule): DateSchema
    {
        $this->schema[$this->source]['min'] = $rule;
        return $this;
    }

    /**
     * @param string $rule
     * @return $this
     */
    public function max($rule): DateSchema
    {
        $this->schema[$this->source]['max'] = $rule;
        return $this;
    }
    /**
     * @return $this
     */
    function now(): DateSchema
    {
        $this->schema[$this->source]["now"] = true;
        return $this;
    }
    /**
     * @return $this
     */
    function today(): DateSchema
    {
        $this->schema[$this->source]["today"]=true;
        return $this;
    }
}