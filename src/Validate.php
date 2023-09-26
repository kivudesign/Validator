<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App;

use Wepesi\App\Providers\Contracts\MessageBuilderContracts;
use Wepesi\Resolver\OptionsResolver;
use Wepesi\Resolver\Option;
/**
 *
 */
final class Validate
{
    /**
     * @var array
     */
    private array $errors;
    /**
     * @var bool
     */
    private bool $passed;
    /**
     * @var MessageErrorBuilder
     */
    private MessageErrorBuilder $message;
    /**
     *
     */
    function __construct()
    {
        $this->errors = [];
        $this->passed = false;
        $this->message = new MessageErrorBuilder();
    }

    /**
     * @param array $resource data source where the information will be extracted;
     * @param array $schema data schema
     * @return void
     */
    function check(array $resource, array $schema)
    {
        try {
            $this->errors = [];
            $option_resolver = [];
            /**
             * use of Option resolver to catch all undefined key
             * on the source data
             */
            foreach ($resource as $item => $response) {
                $option_resolver[] = new Option($item);
            }
            $resolver = new OptionsResolver($option_resolver);
            $options = $resolver->resolve($schema);

            $exceptions = isset($options['InvalidArgumentException']) ?? false;
            if ($exceptions) {
                $this->message
                    ->type('object.unknown')
                    ->message($options['InvalidArgumentException'])
                    ->label("exception");
                $this->addError($this->message);
            } else {
                foreach ($schema as $item => $rules) {
                    if (!is_array($rules) && is_object($rules)) {
                        if(!$rules->generate()){
                            throw new \Exception("Schema rule is not a valid schema! method generate does not exist");
                        }
                        $rules = $rules->generate();
                    }
                    $class_namespace = array_keys($rules)[0];
                    // In case the method is defined as any it will not be checked.
                    if ($class_namespace == "any") continue;
                    $validator_class = str_replace("Schema", "Validator", $class_namespace);
                    $reflexion = new \ReflectionClass($validator_class);

                    $instance = $reflexion->newInstance($item, $resource);

                    foreach ($rules[$class_namespace] as $method => $params) {
                        if (method_exists($instance, $method)) {
                            call_user_func_array([$instance, $method], [$params]);
                        }
                    }
                    $result = $instance->result();
                    if (count($result) > 0) {
                        $this->errors = array_merge($this->errors, $result);
                    }
                }
                if (count($this->errors) == 0) {
                    $this->passed = true;
                }
            }
        } catch (\Exception $ex) {
            die($ex);
        }
    }

    /**
     * @param MessageBuilderContracts $item
     * @return void
     */
    private function addError(MessageBuilderContracts $item)
    {
        $this->errors[] = $item->generate();
    }

    /**
     * @return array
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function passed(): bool
    {
        return $this->passed;
    }
}