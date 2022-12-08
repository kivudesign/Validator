<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Resolver;

use Wepesi\App\Traits\ExceptionTraits;

/**
 * Class OptionsResolver
 * @package Wepesi\App\Resolver
 */
final class OptionsResolver
{
    private \ArrayObject $options;
    use ExceptionTraits;

    public function __construct(array $options)
    {
        $this->options = new \ArrayObject();
        foreach ($options as $option) {
            $this->add($option);
        }
    }

    public function resolve(array $options): array
    {
        try {
            $checkDiff = $this->checkDiff($options);
            if(isset($checkDiff['exception'])){
                return $checkDiff;
            }
            /**
             * @var Option $option
             */
            $optionsResolved = [];
            foreach ($this->options as $option) {
                $optionName = $option->getName();
                if (\array_key_exists($optionName, $options)) {
                    $value = $options[$optionName];
                    if ($option->isValid($value) === false) {
                        throw new \InvalidArgumentException(sprintf('The option "%s" with value %s is invalid.', $optionName, self::formatValue($value)));
                    }
                    $optionsResolved[$optionName] = $value;
                    continue;
                }

                if ($option->hasDefaultValue()) {
                    $optionsResolved[$optionName] = $option->getDefaultValue();
                    continue;
                }

                throw new \InvalidArgumentException(sprintf('The required option "%s" is missing.', $optionName));
            }
            return $optionsResolved;
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * @param Option $option
     * @return void
     */
    private function add(Option $option): void
    {
        $this->options->offsetSet($option->getName(), $option);
    }

    private function checkDiff(array $options): array
    {
        try {
            $defined = $this->options->getArrayCopy();
            $diff = array_diff_key($options, $defined);
            if (count($diff) > 0) {
                throw new \InvalidArgumentException(\sprintf(
                        'The option(s) "%s" do(es) not exist. Defined options are: "%s".',
                        implode(', ', array_keys($diff)),
                        implode('", "', array_keys($defined)))
                );
            }
            return [];
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    private static function formatValue($value): string
    {
        if (is_object($value)) {
            return \get_class($value);
        }

        if (is_string($value)) {
            return '"' . $value . '"';
        }

        if (false === $value) {
            return 'false';
        }

        if (true === $value) {
            return 'true';
        }

        return \gettype($value);
    }
}