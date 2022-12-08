<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App;

use Wepesi\App\Schema\BooleanSchema;
use Wepesi\App\Schema\DateSchema;
use Wepesi\App\Schema\NumberSchema;
use Wepesi\App\Schema\StringSchema;

class Schema
{

    function any(): array
    {
        return ['any' => true];
    }

    /**
     * @return StringSchema
     */
    public function string(): StringSchema
    {
        return new class extends StringSchema{};
    }

    /**
     * @return NumberSchema
     */
    public function number(): NumberSchema
    {
        return new NumberSchema();
    }

    /**
     * @return DateSchema
     */
    public function date(): DateSchema
    {
        return new DateSchema();
    }

    /**
     * @return BooleanSchema
     */
    public function boolean(): BooleanSchema
    {
        return new BooleanSchema();
    }

}