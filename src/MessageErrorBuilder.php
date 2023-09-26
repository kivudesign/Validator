<?php
/*
 * Copyright (c) 2023.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App;

use Wepesi\App\Providers\Contracts\MessageBuilderContracts;

/**
 *
 */
final class MessageErrorBuilder implements MessageBuilderContracts
{

    /**
     * @var array
     */
    private array $items;

    /**
     *
     */
    public function __construct(){
        $this->items = [];
    }

    /**
     * @param string $value
     * @return $this
     */
    public function type(string $value): MessageErrorBuilder
    {
        $this->items['type'] = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function message(string $value): MessageErrorBuilder
    {
        $this->items['message'] = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function label(string $value): MessageErrorBuilder
    {
        $this->items['label'] = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function limit(string $value): MessageErrorBuilder
    {
        $this->items['limit'] = $value;
        return $this;
    }

    /**
     * @return array
     */
    private function generate(){
        return $this->items;
    }

    /**
     * @param $method
     * @param $arg
     * @return mixed|void
     */
    public function __call($method, $arg)
    {
        if (method_exists($this, $method)) {
            return call_user_func_array([$this, $method], $arg);
        }
    }
}