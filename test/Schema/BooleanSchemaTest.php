<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Test\Schema;


use PHPUnit\Framework\TestCase;
use Wepesi\App\Schema\BooleanSchema;

class BooleanSchemaTest extends TestCase
{
    function testBooleanIsObject()
    {
        $booleanSchema = new class extends BooleanSchema{};
        $this->assertIsObject($booleanSchema);
    }

    function testStringObjectIsKey()
    {
        $booleanSchema = new class extends BooleanSchema{};
        $this->assertArrayHasKey('BooleanValidator', $booleanSchema->generate());
    }

    function testBooleanIsRequireddKey()
    {
        $booleanSchema = new class extends BooleanSchema{};
        $subset_array = ['BooleanValidator' => ['required' => true]];
        $this->assertEquals($subset_array, $booleanSchema->required()->generate());
    }
    function testBooleanIsValidKey()
    {
        $booleanSchema = new class extends BooleanSchema{};
        $subset_array = ['BooleanValidator' => ['isValid' => true]];
        $this->assertEquals($subset_array, $booleanSchema->isValid()->generate());
    }
}