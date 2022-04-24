<?php


namespace Wepesi\App\Schema;
/**
 * Description of VDate
 *
 * @author Boss Ibrahim Mussa
 */
class DateSchema extends SChema
{
    function __construct() {
        $this->source="VDate";
        $this->schema[$this->source]=[];
    }

    /**
     * @return $this
     */
    function now(): DateSchema
    {
        $this->schema[$this->source]["now"]=true;
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