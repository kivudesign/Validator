<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Test;


use PHPUnit\Framework\TestCase;
use Wepesi\App\Schema;

class SchemaTest extends TestCase
{
    function testSchemaObject(){
        $schema = new Schema();
        $this->assertIsObject($schema);
    }
    function testSchemaStringObject(){
        $schema = new Schema();
        $rules=["name"=>$schema->string()->min(3)->max(10)->required()->generate()];
        $expected=[
            "name"=>[
                "StringValidator"=>[
                    "min"=>3,
                    "max"=>10,
                    "required"=>true
                ]
            ]
        ];
        $this->assertEquals($rules,$expected);
    }
    function testSchemaStringErrorObject(){
        $schema = new Schema();
        $rules=["name" => $schema->string()->min(3)->max(10)->required()];
        $expected=[
            "name"=>[
                "StringValidator"=>[
                    "min"=>3,
                    "max"=>10,
                    "required"=>true
                ]
            ]
        ];
        $this->assertIsNotArray($rules["name"]);
        $this->assertNotEquals($expected,$rules);
    }
}