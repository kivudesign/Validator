<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Test\Schema;


use PHPUnit\Framework\TestCase;
use Wepesi\App\Schema\DateSchema;

/**
 *
 */
class DateSchemaTest extends TestCase
{
    private string $dateSchema = 'Wepesi\\App\\Schema\\DateSchema';
    /**
     * @return void
     */
    public function testStringIsObject()
    {
        $dateSchema = new DateSchema();
        $this->assertIsObject($dateSchema);
    }

    /**
     * @return void
     */
    public function testStringObjectIsKey()
    {
        $dateSchema = new DateSchema();
        $this->assertArrayHasKey($this->dateSchema, $dateSchema->generate());
    }

    /**
     * @return void
     */
    public function testDateNowKey()
    {
        $dateSchema = new DateSchema();
        $subset_array = [$this->dateSchema => ['now' => true]];
        $this->assertEquals($subset_array, $dateSchema->now()->generate());
    }

    /**
     * @return void
     */
    public function testDateTodayKey()
    {
        $dateSchema = new DateSchema();
        $subset_array = [$this->dateSchema => ['today' => true]];
        $this->assertEquals($subset_array, $dateSchema->today()->generate());
    }
}