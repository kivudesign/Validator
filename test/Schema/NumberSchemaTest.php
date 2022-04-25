<?php


namespace Test\Schema;


use PHPUnit\Framework\TestCase;
use Wepesi\App\Schema\NumberSchema;

class NumberSchemaTest extends TestCase
{
    function testStringIsObject()
    {
        $numberSchema = new NumberSchema();
        $this->assertIsObject($numberSchema);
    }

    function testStringObjectIsKey()
    {
        $numberSchema = new NumberSchema();
        $this->assertArrayHasKey('VNumber', $numberSchema->check());
    }

    function testRequiredKey()
    {
        $numberSchema = new NumberSchema();
        $subset_array = ['VNumber' => ['required' => true]];
        $this->assertEquals($subset_array, $numberSchema->required()->check());
    }
    function testNumberPositiveKey()
    {
        $numberSchema = new NumberSchema();
        $subset_array = ['VNumber' => ['positive' => true]];
        $this->assertEquals($subset_array, $numberSchema->positive()->check());
    }
}