<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App;

use Exception;
use ReflectionClass;
use Wepesi\App\Resolver\Option;
use Wepesi\App\Resolver\OptionsResolver;


class Validate
{
    private array $errors;
    private bool $passed;

    function __construct()
    {
        $this->errors = [];
        $this->passed = false;
    }

    /**
     * @param array $resource data source where the information will be extracted;
     * @param array $schema data schema
     * @return void
     */
    function check(array $resource, array $schema){
        try {


            $this->errors = [];
            $option_resolver = [];
            /**
             * use of Option resolver to catch all undefined key
             * Check for undefined object
             */
            foreach ($resource as $item => $response) {
                $option_resolver[] = new Option($item);
            }
            $resolver = new OptionsResolver($option_resolver);
            $options = $resolver->resolve($schema);
            if (isset($options["exception"])) {
                $message = [
                    'type' => 'object.unknown',
                    'message' => $options["exception"],
                    'label' => "label",
                ];
                $this->addError($message);
            }else{
                foreach ($schema as $item => $rules) {
                    $key = array_keys($rules)[0];
                    if ($key == "any") continue;
                    $value = $resource[$item];

                    $class_name = "\Wepesi\App\Validator\\".$key;

                    $reflexion = new ReflectionClass($class_name);

                    $instance = $reflexion->newInstance($item, $value,$resource);

                    foreach ($rules[$key] as $method => $params){
                        if(method_exists($instance,$method)){
                            call_user_func_array([$instance,$method],[$params]);
                        }
                    }
                    $result = $instance->result();
                    if( count($result)>0 ){
                        $this->errors = array_merge($this->errors,$result);
                    }
                }
                if ( count($this->errors) == 0) {
                    $this->passed = true;
                }
            }
        }catch (Exception $ex){
            $message = [
                'type' => 'object.unknown',
                'message' => $ex,
                'label' => "unknown",
            ];
            $this->addError($message);
        }
    }

    private function addError(array $message){
        $this->errors[] = $message;
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