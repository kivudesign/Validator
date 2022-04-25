<?php


namespace Test\Schema;


use PHPUnit\Framework\TestCase;
use Wepesi\App\Schema\DateSchema;

class DateSchemaTest extends TestCase
{
    function testStringIsObject()
    {
        $dateSchema = new DateSchema();
        $this->assertIsObject($dateSchema);
    }

    function testStringObjectIsKey()
    {
        $dateSchema = new DateSchema();
        $this->assertArrayHasKey('VDate', $dateSchema->check());
    }

    function testDateNowKey()
    {
        $dateSchema = new DateSchema();
        $subset_array = ['VDate' => ['now' => true]];
        $this->assertEquals($subset_array, $dateSchema->now()->check());
    }
    function testDateTodayKey()
    {
        $dateSchema = new DateSchema();
        $subset_array = ['VDate' => ['today' => true]];
        $this->assertEquals($subset_array, $dateSchema->today()->check());
    }
}