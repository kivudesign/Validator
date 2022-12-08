<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Test\Schema;


use PHPUnit\Framework\TestCase;
use Wepesi\App\Schema\NumberSchema;

class NumberSchemaTest extends TestCase
{
    function testStringIsObject()
    {
        $numberSchema = new class extends NumberSchema{};
        $this->assertIsObject($numberSchema);
    }

    function testStringObjectIsKey()
    {
        $numberSchema = new class extends NumberSchema{};
        $this->assertArrayHasKey("NumberValidator", $numberSchema->generate());
    }

    function testRequiredKey()
    {
        $numberSchema = new class extends NumberSchema{};
        $subset_array = ["NumberValidator" => ['required' => true]];
        $this->assertEquals($subset_array, $numberSchema->required()->generate());
    }
    function testNumberPositiveKey()
    {
        $numberSchema = new class extends NumberSchema{};
        $subset_array = ["NumberValidator" => ['positive' => true]];
        $this->assertEquals($subset_array, $numberSchema->positive()->generate());
    }
}