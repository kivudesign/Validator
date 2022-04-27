<?php


namespace Test\Schema;


use PHPUnit\Framework\TestCase;
use Wepesi\App\Schema\StringSchema;

class StringSchemaTest extends TestCase
{
    function testStringIsObject(){
        $stringSchema= new StringSchema();
        $this->assertIsObject($stringSchema);
    }
    function testStringObjectIsKey(){
        $stringSchema= new StringSchema();
        $this->assertArrayHasKey("String",$stringSchema->check());
    }
    function testStringEmailKey(){
        $stringSchema = new StringSchema();
        $subset_array=["String"=>["email"=>true]];
        $this->assertEquals($subset_array, $stringSchema->email()->check());
    }
    function testStringURLKey(){
        $stringSchema = new StringSchema();
        $subset_array=["String"=>["url"=>true]];
        $this->assertEquals($subset_array, $stringSchema->url()->check());
    }
    function testStringMatchKey(){
        $stringSchema = new StringSchema();
        $subset_array=["String"=>["match"=>'email']];
        $this->assertEquals($subset_array, $stringSchema->match('email')->check());
    }
    function testStringMinimumKey(){
        $stringSchema = new StringSchema();
        $subset_array=["String"=>["min"=>1]];
        $this->assertEquals($subset_array, $stringSchema->min(1)->check());
    }
    function testStringMaximumKey(){
        $stringSchema = new StringSchema();
        $subset_array=["String"=>["max"=>10]];
        $this->assertEquals($subset_array, $stringSchema->max(10)->check());
    }
}