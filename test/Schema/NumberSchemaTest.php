<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Test\Schema;


use PHPUnit\Framework\TestCase;
use Wepesi\App\Schema\NumberSchema;

/**
 *
 */
class NumberSchemaTest extends TestCase
{
    private string $numberSchema = 'Wepesi\\App\\Schema\\NumberSchema';
    /**
     * @return void
     */
    public function testStringIsObject()
    {
        $numberSchema = new NumberSchema();
        $this->assertIsObject($numberSchema);
    }

    /**
     * @return void
     */
    public function testStringObjectIsKey()
    {
        $numberSchema = new NumberSchema();
        $this->assertArrayHasKey($this->numberSchema, $numberSchema->generate());
    }

    /**
     * @return void
     */
    public function testRequiredKey()
    {
        $numberSchema = new NumberSchema();
        $subset_array = [$this->numberSchema => ['required' => true]];
        $this->assertEquals($subset_array, $numberSchema->required()->generate());
    }

    /**
     * @return void
     */
    public function testNumberPositiveKey()
    {
        $numberSchema = new NumberSchema();
        $subset_array = [$this->numberSchema => ['positive' => true]];
        $this->assertEquals($subset_array, $numberSchema->positive()->generate());
    }
}