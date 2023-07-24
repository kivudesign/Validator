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
    public function testStringIsObject()
    {
        $dateSchema = new DateSchema();
        $this->assertIsObject($dateSchema);
    }

    public function testStringObjectIsKey()
    {
        $dateSchema = new DateSchema();
        $this->assertArrayHasKey('DateValidator', $dateSchema->generate());
    }

    public function testDateNowKey()
    {
        $dateSchema = new DateSchema();
        $subset_array = ['DateValidator' => ['now' => true]];
        $this->assertEquals($subset_array, $dateSchema->now()->generate());
    }
    public function testDateTodayKey()
    {
        $dateSchema = new DateSchema();
        $subset_array = ['DateValidator' => ['today' => true]];
        $this->assertEquals($subset_array, $dateSchema->today()->generate());
    }
}