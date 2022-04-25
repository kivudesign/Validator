<?php


namespace Test\Schema;


use PHPUnit\Framework\TestCase;
use Wepesi\App\Schema\BooleanSchema;

class BooleanSchemaTest extends TestCase
{
    function testBooleanIsObject()
    {
        $booleanSchema = new BooleanSchema();
        $this->assertIsObject($booleanSchema);
    }

    function testStringObjectIsKey()
    {
        $booleanSchema = new BooleanSchema();
        $this->assertArrayHasKey('VBolean', $booleanSchema->check());
    }

    function testBooleanIsRequireddKey()
    {
        $booleanSchema = new BooleanSchema();
        $subset_array = ['VBolean' => ['required' => true]];
        $this->assertEquals($subset_array, $booleanSchema->required()->check());
    }
    function testBooleanIsValidKey()
    {
        $booleanSchema = new BooleanSchema();
        $subset_array = ['VBolean' => ['isValid' => true]];
        $this->assertEquals($subset_array, $booleanSchema->isValid()->check());
    }
}