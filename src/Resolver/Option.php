<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Resolver;

use Closure;

/**
 * Class Option
 * @package Wepesi\App\Resolver
 */
final class Option
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @var mixed
     */
    private $defaultValue;

    /**
     * @var bool
     */
    private bool $hasDefaultValue;

    /**
     * @var Closure|null
     */
    private ?Closure $validator = null;

    /**
     * Option constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->hasDefaultValue = false;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * @param mixed $defaultValue
     * @return Option
     */
    public function setDefaultValue($defaultValue): self
    {
        $this->hasDefaultValue = true;
        $this->defaultValue = $defaultValue;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasDefaultValue(): bool
    {
        return $this->hasDefaultValue;
    }

    /**
     * @param Closure $closure
     * @return $this
     */
    public function validator(Closure $closure): self
    {
        $this->validator = $closure;
        return $this;
    }

    /**
     * @param $value
     * @return bool
     */
    public function isValid($value): bool
    {
        if ($this->validator instanceof Closure) {
            $validator = $this->validator;
            return $validator($value);
        }
        return true;
    }
}