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
        parent::__construct(__CLASS__);
    }

    /**
     * @param string $rule
     * @return DateSchema
     */
    public function min($rule): DateSchema
    {
        $this->schema[$this->class_name]['min'] = $rule;
        return $this;
    }

    /**
     * @param string $rule
     * @return $this
     */
    public function max($rule): DateSchema
    {
        $this->schema[$this->class_name]['max'] = $rule;
        return $this;
    }
    /**
     * @return $this
     */
    function now(): DateSchema
    {
        $this->schema[$this->class_name]["now"] = true;
        return $this;
    }
    /**
     * @return $this
     */
    function today(): DateSchema
    {
        $this->schema[$this->class_name]["today"]=true;
        return $this;
    }
}