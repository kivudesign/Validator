<?php


namespace Test;


use PHPUnit\Framework\TestCase;
use Wepesi\App\Validate;

class ValidationTest extends TestCase
{
    function testValidationObject(){
        $validate = new Validate();
        $this->assertIsObject($validate);
    }
}