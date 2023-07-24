<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Wepesi\App;

use ReflectionClass;
use Wepesi\App\Resolver\Option;
use Wepesi\App\Resolver\OptionsResolver;

/**
 *
 */
class Validate
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
     *
     */
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
             * on the source data
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
                    'label' => "exception",
                ];
                $this->addError($message);
            }else{
                foreach ($schema as $item => $rules) {
                    if(!is_array($rules)){
                        throw new \Exception("Trying to access array offset on value of type null! method generate not called");
                    }
                    $class_namespace = array_keys($rules)[0];
                    if ($class_namespace == "any") continue;

                    $validator_class = str_replace("Schema","Validator",$class_namespace);
                    $reflexion = new ReflectionClass($validator_class);

                    $instance = $reflexion->newInstance($item,$resource);

                    foreach ($rules[$class_namespace] as $method => $params){
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
        }catch (\Exception $ex){
            die($ex);
        }
    }

    /**
     * @param array $message
     * @return void
     */
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