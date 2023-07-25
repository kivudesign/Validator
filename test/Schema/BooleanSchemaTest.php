<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Test\Schema;


use PHPUnit\Framework\TestCase;
use Wepesi\App\Schema\BooleanSchema;

/**
 *
 */
class BooleanSchemaTest extends TestCase
{
    private string $booleanSchema = 'Wepesi\\App\\Schema\\BooleanSchema';
    /**
     * @return void
     */
    public function testBooleanIsObject()
    {
        $booleanSchema = new BooleanSchema();
        $this->assertIsObject($booleanSchema);
    }

    /**
     * @return void
     */
    public function testStringObjectIsKey()
    {
        $booleanSchema = new BooleanSchema();
        $this->assertArrayHasKey($this->booleanSchema, $booleanSchema->generate());
    }

    /**
     * @return void
     */
    public function testBooleanIsRequireddKey()
    {
        $booleanSchema = new BooleanSchema();
        $subset_array = [$this->booleanSchema => ['required' => true]];
        $this->assertEquals($subset_array, $booleanSchema->required()->generate());
    }

    /**
     * @return void
     */
    public function testBooleanIsValidKey()
    {
        $booleanSchema = new BooleanSchema();
        $subset_array = [$this->booleanSchema => ['isValid' => true]];
        $this->assertEquals($subset_array, $booleanSchema->isValid()->generate());
    }
}