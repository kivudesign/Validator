<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Providers;

use Wepesi\App\MessageErrorBuilder;
use Wepesi\App\Providers\Contracts\Contracts;
use Wepesi\App\Providers\Contracts\MessageBuilderContracts;

/**
 * Validator provider model
 */
abstract class ValidatorProvider implements Contracts
{
    /**
     * @var array
     */
    protected array $errors;
    /**
     * @var array
     */
    protected array $data_source;
    /**
     * @var string
     */
    protected string $field_name;
    /**
     * @var
     */
    protected $field_value;
    /**
     * @var MessageErrorBuilder
     */
    protected MessageErrorBuilder $message_error_builder;

    function __construct(string $item, array $data_source = [])
    {
        $this->errors = [];
        $this->message_error_builder = new MessageErrorBuilder();
        $this->data_source = $data_source;
        $this->field_name = $item;
        $this->field_value = $data_source[$item];
    }

    /**
     * @param int $rule
     * @return mixed
     */
    abstract public function min(int $rule);

    /**
     * @param int $rule
     * @return mixed
     */
    abstract public function max(int $rule);

    /**
     * Provide validation module name
     * @return string
     */
    protected function classProvider(): string {
        $reflexion = new \ReflectionClass($this);
        return str_replace('validator','',strtolower($reflexion->getShortName()));
    }

    /**
     * @return string
     */
    private function getClassProvider(): string
    {
        $reflexion = new \ReflectionClass($this);
        return str_replace('validator','',strtolower($reflexion->getShortName()));
    }
    /**
     * @return void
     */
    public function required()
    {
        if (is_array($this->field_value)) {
            if (count($this->field_value) == 0) {
                $this->message_error_builder
                    ->type($this->getClassProvider() . ' required')
                    ->label($this->field_name)
                    ->message("'$this->field_name' is required");
                $this->addError($this->message_error_builder);
            }
        } else {
            $required_value = trim($this->field_value);
            if (strlen($required_value) == 0) {
                $this->message_error_builder
                    ->type($this->getClassProvider() . ' required')
                    ->message("'$this->field_name' is required")
                    ->label($this->field_name);
                $this->addError($this->message_error_builder);
            }
        }
    }

    /**
     *
     * @param MessageBuilderContracts $item
     * @return void
     */
    public function addError(MessageBuilderContracts $item): void
    {
        $this->errors[] = $item->generate();
    }

    /**
     * @return array
     */
    public function result(): array
    {
        return $this->errors;
    }

    /**
     * @param int $rule
     * @param bool $max
     * @return bool
     */
    protected function checkNotPositiveParamMethod(int $rule, bool $max = false): bool
    {
        $status = false;
        if ($rule < 1) {
            $method = $max ? 'max' : 'min';
            $this->message_error_builder
                ->type($this->getClassProvider() . ' method ' . $method)
                ->message("'$this->field_name' $method param should be a positive number")
                ->label($this->field_name);
            $this->addError($this->message_error_builder);
            $status = true;
        }
        return $status;
    }

    protected function typeError(string $type){
        return $this->getClassProvider() . ".$type";
    }
}