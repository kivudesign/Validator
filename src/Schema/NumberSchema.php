<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Schema;

use Wepesi\App\Providers\SchemaProvider;

/**
 * Schema number validation
 * validate any format number
 */
final class NumberSchema extends SchemaProvider
{
    /**
     * @return $this
     */
    public function positive(): NumberSchema
    {
        $this->schema['positive'] = true;
        return $this;
    }

    /**
     * @return $this
     */
    public function negative(): NumberSchema
    {
        $this->schema['negative'] = true;
        return $this;
    }
}
