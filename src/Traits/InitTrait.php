<?php


namespace Wepesi\App\Traits;


trait InitTrait
{
    /**
     * @throws \Exception
     */
    private function initInstance($source, $schema)
    {
        if (!is_array($source) || count($source) == 0) {
            throw new Exception('Your Source Data should not be en empty array');
        }
        if (!is_array($schema) || count($schema) == 0) {
            throw new Exception('Your Schema should not be en empty array');
        }
        $fields = array_keys($schema);

        if (!isset($source[$fields[0]])) {
            throw new \Exception('field not defined');
        }

        $this->extract_data($schema);
    }

    /**
     * @param array $schema
     */
    protected function extract_data(array $schema ){
        $conditions=$schema[$this->field_item]['String'];
        foreach ($conditions as $key=>$value){
            call_user_func([$this,$key],$value);
            return;
        }
    }
}