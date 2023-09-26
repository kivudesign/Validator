<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Schema;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Wepesi\App\Providers\SchemaProvider;


/**
 * String validation schema
 * validate string value
 */
final class StringSchema extends SchemaProvider
{
    /**
     * @return $this
     */
    public function email(): StringSchema
    {
        $this->schema["email"] = true;
        return $this;
    }

    /**
     *
     * @return $this
     */
    public function url(): StringSchema
    {
        $this->schema["url"] = true;
        return $this;
    }

    /**
     *
     * @param string $key_to_match
     * @return $this
     */
    public function match(string $key_to_match): StringSchema
    {
        $this->schema["match"] = $key_to_match;
        return $this;
    }

    /**
     * @param bool $ipv6
     * @return $this
     */
    public function addressIp(bool $ipv6 = false): StringSchema
    {
        if ($ipv6) {
            $this->schema['addressIpv6'] = true;
        } else {
            $this->schema['addressIp'] = true;
        }
        return $this;
    }
}