<?php
namespace Wepesi\App\Script;

use Exception;
use Wepesi\App\Providers\ValidationProvider;

/**
 * Description of String
 *
 * @author Boss Ibrahim Mussa
 */
class StringValidation extends ValidationProvider {
    private string $string_value, $field_item,$field_value;
    private array $source_data;
    protected ?array $errors;
    private int $_min, $_max;

    /**
     *
     * @param array $source
     * @param array $schema
     * @throws Exception
     */
    function __construct(array $source,array $schema) {
        $this->initInstance($source,$schema);
        $fields=array_keys($schema);
        $this->field_item = $fields[0];
        //
        $this->source_data = $source;
    }

    /**
     * @param array $schema
     */
    private function extract_data(array $schema ){
        $conditions=$schema[$this->field_item]['String'];
        foreach ($conditions as $key=>$value){
            call_user_func([$this,$key],$value);
            return;
        }
    }

    /**
     * @throws Exception
     */
    private function initInstance($source, $schema){
        $this->errors=null;
        $this->_min=0;
        $this->_max=1;
        $this->source_data=[];
        $this->field_value="";
        //
        if(!is_array($source) || count($source)==0){
            throw new Exception("Your Source Data should not be en empty array");
        }
        if(!is_array($schema) || count($schema)==0){
            throw new Exception("Your Schema should not be en empty array");
        }
        $fields=array_keys($schema);
        $this->field_item=$fields[0];
        //
        $this->source_data=$source;
        if(!isset($source[$fields[0]])){
            throw new \Exception("field not defined");
        }
        $this->field_value=$source[$fields[0]];
        if($this->isString($fields[0])){
            $this->string_value=$this->field_value;
        };
        $this->extract_data($schema);
    }

    /**
     *
     * @param int $rule
     *
     */
    function min($rule):void
    {
        if (strlen($this->field_value) < $rule) {
            $message=[
                "type"=>"string.min",
                "message"=> "`$this->field_item` should have minimum of `$rule` characters",
                "label"=>$this->field_item,
                "limit"=>$rule
            ];
            $this->addError($message);
        }
    }

    /**
     *
     * @param int $rule
     *
     */
    function max($rule)
    {
        $this->_max=$rule;
        if (strlen($this->string_value) > $rule) {
            $message = [
                "type" => "string.max",
                "message" => "`$this->field_item` should have maximum of `$rule` characters",
                "label" => $this->field_item,
                "limit" => $rule
            ];
            $this->addError($message);
        }
    }


    function email()
    {
        if (!filter_var($this->string_value, FILTER_VALIDATE_EMAIL)) {
            $message = [
                "type" => "string.email",
                "message" => ("`$this->field_item` should be an email."),
                "label" => $this->field_item,
            ];
            $this->addError($message);
        }
    }

    /**
     *supported link :
     * http(s)://[domain].[extension] ,
     * http(s)://www.[domain].[extension],
     * www.[domain].[extension]
     *
     */
    function url()
    {
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $this->string_value)) {
            $message = [
                "type" => "string.url",
                "message" => ("`{$this->field_item}` this should be a link(url)"),
                "label" => $this->field_item,
            ];
            $this->addError($message);
        }
    }

    /**
     *
     * @param string $key_to_match
     *
     */
    function match(string $key_to_match)
    {
        $this->isString($key_to_match);
        if (isset($this->source_data[$key_to_match]) && (strlen($this->string_value)!= strlen($this->source_data[$key_to_match])) && ($this->string_value!=$this->source_data[$key_to_match])) {
            $message = [
                "type" => "string.match",
                "message" => "`$this->field_item` should match `$key_to_match`",
                "label" => $this->field_item,
            ];
            $this->addError($message);
        }
    }

    function required()
    {
        $required_value= trim($this->field_value);
        if (strlen($required_value)==0) {
            $message = [
                "type"=> "string.required",
                "message" => "`$this->field_item` is required",
                "label" => $this->field_item,
            ];
            $this->addError($message);
        }
    }

    /**
     *
     * @param string $item_key
     * @return boolean
     */
    private function isString(string $item_key): bool
    {
        $field_to_check=!$item_key?$this->field_item:$item_key;
        $regex="#[a-zA-Z0-9]#";
        if(!preg_match($regex,$this->source_data[$field_to_check]) || strlen(trim($this->field_value))==0){
            $message=[
                    "type" => "string.unknown",
                    "message" => ("`$field_to_check` should be a string"),
                    "label" => $field_to_check,
                ];
                $this->addError($message);
                return false;
        }
        return true;
    }
}
