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
        parent::__construct(get_class($this));
    }

    public function object(array $dataobject){
        $this->schema[$this->source]['object'] = $dataobject;
        return $this;
    }
}