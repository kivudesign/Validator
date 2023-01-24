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
     * @param array $elements data array to be validated
     * @return $this
     */
    public function elements(array $elements):ArraySchema{
        if(isset($this->schema[$this->class_name]['string']) || isset($this->schema[$this->class_name]['number'])) {
            return false;
        }
        $this->schema[$this->class_name]['elements'] = $elements;
        return $this;
    }

    /**
     *  check if array content are(is) string
     * @return $this|null
     */
    public function string():?ArraySchema{
        if(isset($this->schema[$this->class_name]['number'])) {
            return false;
        }
        $this->schema[$this->class_name]['string'] = true;
        return $this;
    }

    /**
     * @return $this|null
     */
    public function number():?ArraySchema{
        if(isset($this->schema[$this->class_name]['string'])) {
            return false;
        }
        $this->schema[$this->class_name]['number'] = true;
        return $this;
    }
}