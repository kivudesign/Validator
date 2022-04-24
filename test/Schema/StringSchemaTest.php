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
        $this->assertArrayHasKey("VString",$stringSchema->check());
    }
    function testStringEmailKey(){
        $stringSchema = new StringSchema();
        $subset_array=["VString"=>["email"=>true]];
        $this->assertEquals($subset_array, $stringSchema->email()->check());
    }
    function testStringURLKey(){
        $stringSchema = new StringSchema();
        $subset_array=["VString"=>["url"=>true]];
        $this->assertEquals($subset_array, $stringSchema->url()->check());
    }
    function testStringMatchKey(){
        $stringSchema = new StringSchema();
        $subset_array=["VString"=>["match"=>'email']];
        $this->assertEquals($subset_array, $stringSchema->match('email')->check());
    }
    function testStringMinimumKey(){
        $stringSchema = new StringSchema();
        $subset_array=["VString"=>["min"=>1]];
        $this->assertEquals($subset_array, $stringSchema->min(1)->check());
    }
    function testStringMaximumKey(){
        $stringSchema = new StringSchema();
        $subset_array=["VString"=>["max"=>10]];
        $this->assertEquals($subset_array, $stringSchema->max(10)->check());
    }
}