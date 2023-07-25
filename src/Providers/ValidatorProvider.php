<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App\Providers;

use Wepesi\App\Providers\Contracts\Contracts;

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
     *
     */
    function __construct()
    {
        $this->errors = [];
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
    abstract protected function classProvider(): string ;

    /**
     * @return string
     */
    private function getClassProvider(): string
    {
        return $this->classProvider && strlen($this->classProvider) > 0 ? $this->classProvider : 'unknown';
    }
    /**
     * @return void
     */
    public function required()
    {
        if (is_array($this->field_value)) {
            if (count($this->field_value) == 0) {
                $message = [
                    'type' => $this->getClassProvider() . ' required',
                    'message' => "'$this->field_name' is required",
                    'label' => $this->field_name,
                ];
                $this->addError($message);
            }
        } else {
            $required_value = trim($this->field_value);
            if (strlen($required_value) == 0) {
                $message = [
                    'type' => $this->classProvider() . ' required',
                    'message' => "'$this->field_name' is required",
                    'label' => $this->field_name,
                ];
                $this->addError($message);
            }
        }
    }

    /**
     *
     * @param array $value
     * @return void
     */
    public function addError(array $value): void
    {
        $this->errors[] = $value;
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
    protected function positiveParamMethod(int $rule, bool $max = false): bool
    {
        $status = true;
        if ($rule < 1) {
            $method = $max ? "max" : "min";
            $message = [
                'type' => $this->getClassProvider() . ' method ' . $method,
                'message' => "'$this->field_name' $method param should be a positive number",
                'label' => $this->field_name,
            ];
            $this->addError($message);
            $status = false;
        }
        return $status;
    }
}