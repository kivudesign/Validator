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
    function testValidationStringObject(){
        $validate = new Validate();
        $schema=["name"=>$validate->string()->min(3)->max(10)->required()->check()];
        $expected=[
            "name"=>[
                "String"=>[
                    "min"=>3,
                    "max"=>10,
                    "required"=>true
                ]
            ]
        ];
        $this->assertEquals($schema,$expected);
    }
    function testValidationStringErrorObject(){
        $validate = new Validate();
        $schema=["name"=>$validate->string()->min(3)->max(10)->required()];
        $expected=[
            "name"=>[
                "string"=>[
                    "min"=>3,
                    "max"=>10,
                    "required"=>true
                ]
            ]
        ];
        $this->assertIsNotArray($schema["name"]);
        $this->assertNotEquals($expected,$schema);
    }
}