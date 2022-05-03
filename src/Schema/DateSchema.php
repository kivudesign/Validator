<?php


namespace Wepesi\App\Schema;
use Wepesi\App\Providers\SChemaProvider;

/**
 * Description of VDate
 *
 * @author Boss Ibrahim Mussa
 */
class DateSchema extends SChemaProvider
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