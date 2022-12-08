<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Test\Schema;


use PHPUnit\Framework\TestCase;
use Wepesi\App\Schema\StringSchema;

class StringSchemaTest extends TestCase
{
    function testStringIsObject(){
        $stringSchema = new class extends StringSchema{};
        $this->assertIsObject($stringSchema);
    }
    function testStringObjectIsKey(){
        $stringSchema = new class extends StringSchema{};
        $this->assertArrayHasKey("StringValidator",$stringSchema->generate());
    }
    function testStringEmailKey(){
        $stringSchema = new class extends StringSchema{};
        $subset_array = ["StringValidator"=>["email"=>true]];
        $this->assertEquals($subset_array, $stringSchema->email()->generate());
    }
    function testStringURLKey(){
        $stringSchema = new class extends StringSchema{};
        $subset_array = ["StringValidator"=>["url"=>true]];
        $this->assertEquals($subset_array, $stringSchema->url()->generate());
    }
    function testStringMatchKey(){
        $stringSchema = new class extends StringSchema{};
        $subset_array = ["StringValidator" => ["match"=>'email']];
        $this->assertEquals($subset_array, $stringSchema->match('email')->generate());
    }
    function testStringMinimumKey(){
        $stringSchema = new class extends StringSchema{};
        $subset_array = ["StringValidator" => ["min" => 1]];
        $this->assertEquals($subset_array, $stringSchema->min(1)->generate());
    }
    function testStringMaximumKey(){
        $stringSchema = new class extends StringSchema{};
        $subset_array = ["StringValidator" => ["max" => 10]];
        $this->assertEquals($subset_array, $stringSchema->max(10)->generate());
    }
}