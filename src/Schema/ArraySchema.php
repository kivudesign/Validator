<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Schema;

use Wepesi\App\Providers\SChemaProvider;
use Wepesi\App\Resolver\Option;
use Wepesi\App\Resolver\OptionsResolver;

abstract class ArraySchema extends SChemaProvider
{
    public function __construct()
    {
        parent::__construct(__CLASS__);
    }

    /**
     * @param array $data_object
     * @return $this
     */
    public function object(array $data_object):ArraySchema{
        $this->schema[$this->class_name]['object'] = $data_object;
        return $this;
    }
}