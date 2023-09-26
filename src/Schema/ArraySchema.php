<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Schema;

use Wepesi\App\Providers\SchemaProvider;

/**
 * Array schema validation
 */
final class ArraySchema extends SchemaProvider
{
    /**
     * @param array $elements data array to be validated
     * @return $this
     */
    public function structure(array $elements): ?ArraySchema
    {
        if (! isset($this->schema['string']) || ! isset($this->schema['number'])) {
            $this->schema['structure'] = $elements;
        }
        return $this;
    }

    /**
     *  check if array content are(is) string
     * @return $this|null
     */
    public function string(): ?ArraySchema
    {
        if (! isset($this->schema['number'])) {
            $this->schema['string'] = true;
        }
        return $this;
    }

    /**
     * @return $this|null
     */
    public function number(): ?ArraySchema
    {
        if (! isset($this->schema['string'])) {
            $this->schema['number'] = true;
        }
        return $this;
    }
}