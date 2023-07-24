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
    public function testBooleanIsObject()
    {
        $booleanSchema = new BooleanSchema();
        $this->assertIsObject($booleanSchema);
    }

    public function testStringObjectIsKey()
    {
        $booleanSchema = new BooleanSchema();
        $this->assertArrayHasKey('BooleanValidator', $booleanSchema->generate());
    }

    public function testBooleanIsRequireddKey()
    {
        $booleanSchema = new BooleanSchema();
        $subset_array = ['BooleanValidator' => ['required' => true]];
        $this->assertEquals($subset_array, $booleanSchema->required()->generate());
    }
    public function testBooleanIsValidKey()
    {
        $booleanSchema = new BooleanSchema();
        $subset_array = ['BooleanValidator' => ['isValid' => true]];
        $this->assertEquals($subset_array, $booleanSchema->isValid()->generate());
    }
}