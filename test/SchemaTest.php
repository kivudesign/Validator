<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Test;


use PHPUnit\Framework\TestCase;
use Wepesi\App\Schema;

/**
 *
 */
class SchemaTest extends TestCase
{
    /**
     * @return void
     */
    public function testSchemaObject()
    {
        $schema = new Schema();
        $this->assertIsObject($schema);
    }

    /**
     * @return void
     */
    public function testSchemaStringObject()
    {
        $schema = new Schema();
        $rules = ["name" => $schema->string()->min(3)->max(10)->required()->generate()];
        $expected = [
            "name" => [
                "Wepesi\\App\\Schema\\StringSchema" => [
                    "min" => 3,
                    "max" => 10,
                    "required" => true
                ]
            ]
        ];
        $this->assertEquals($rules, $expected);
    }

    /**
     * @return void
     */
    public function testSchemaStringErrorObject()
    {
        $schema = new Schema();
        $rules = ["name" => $schema->string()->min(3)->max(10)->required()];
        $expected = [
            "name" => [
                "Wepesi\\App\\Schema\\StringSchema" => [
                    "min" => 3,
                    "max" => 10,
                    "required" => true
                ]
            ]
        ];
        $this->assertIsNotArray($rules["name"]);
        $this->assertNotEquals($expected, $rules);
    }

    /*
     * Number Schema Test
     */
    /**
     * @return void
     */
    public function testSchemaNumberObject()
    {
        $schema = new Schema();
        $rules = ["age" => $schema->number()->min(3)->max(10)->required()->positive()->generate()];
        $expected = [
            "age" => [
                "Wepesi\\App\\Schema\\NumberSchema" => [
                    "min" => 3,
                    "max" => 10,
                    "required" => true,
                    "positive" => true,
                ]
            ]
        ];
        $this->assertEquals($rules, $expected);
    }

    /**
     * @return void
     */
    public function testSchemaNumberErrorObject()
    {
        $schema = new Schema();
        $rules = ["age" => $schema->number()->min(5)->max(10)->positive()->required()];
        $expected = [
            "age" => [
                "Wepesi\\App\\Schema\\NumberSchema" => [
                    "min" => 3,
                    "max" => 10,
                    "required" => true,
                    "positive" => false,
                ]
            ]
        ];
        $this->assertIsNotArray($rules["age"]);
        $this->assertNotEquals($expected, $rules);
    }

    /*
     * Number Schema Test
     */
    /**
     * @return void
     */
    public function testSchemaDateObject()
    {
        $schema = new Schema();
        $rules = ["date_creat" => $schema->date()->min("now")->max("2022-12-25")->now()->required()->generate()];
        $expected = [
            "date_creat" => [
                "Wepesi\\App\\Schema\\DateSchema" =>
                    [
                        "min" => "now",
                        "max" => "2022-12-25",
                        "required" => true,
                        "now" => true,
                    ]
            ]
        ];
        $this->assertEquals($rules, $expected);
    }

    /**
     * @return void
     */
    public function testSchemaDateErrorObject()
    {
        $schema = new Schema();
        $rules = ["date_creat" => $schema->date()->min("now")->max("2022-12-25")->required()];
        $expected = [
            "date_creat" => [
                "Wepesi\\App\\Schema\\DateSchema" => [
                    "min" => "now",
                    "max" => "2022-12-25",
                    "required" => true,
                    "positive" => false,
                ]
            ]
        ];
        $this->assertIsNotArray($rules["date_creat"]);
        $this->assertNotEquals($expected, $rules);
    }
}