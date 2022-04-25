<?php

/**
 * Description of validate
 *
 * @author Boss Ibrahim Mussa
 */
namespace Wepesi\App;

use Wepesi\App\Schema\BooleanSchema;
use Wepesi\App\Schema\DateSchema;
use Wepesi\App\Schema\NumberSchema;
use Wepesi\App\Schema\StringSchema;

class Validate
{
    /**
     * @return StringSchema
     */
    function string(): StringSchema
    {
        return new StringSchema();
    }

    /**
     * @return NumberSchema
     */
    function number(): NumberSchema
    {
        return new NumberSchema();
    }

    /**
     * @return DateSchema
     */
    function date(): DateSchema
    {
        return new DateSchema();
    }

    function boolean(): BooleanSchema
    {
        return new BooleanSchema();
    }
}