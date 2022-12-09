<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Test\Schema;


use PHPUnit\Framework\TestCase;
use Wepesi\App\Schema\DateSchema;

class DateSchemaTest extends TestCase
{
    function testStringIsObject()
    {
        $dateSchema = new class extends DateSchema{};
        $this->assertIsObject($dateSchema);
    }

    function testStringObjectIsKey()
    {
        $dateSchema = new class extends DateSchema{};
        $this->assertArrayHasKey('DateValidator', $dateSchema->generate());
    }

    function testDateNowKey()
    {
        $dateSchema = new class extends DateSchema{};
        $subset_array = ['DateValidator' => ['now' => true]];
        $this->assertEquals($subset_array, $dateSchema->now()->generate());
    }
    function testDateTodayKey()
    {
        $dateSchema = new class extends DateSchema{};
        $subset_array = ['DateValidator' => ['today' => true]];
        $this->assertEquals($subset_array, $dateSchema->today()->generate());
    }
}