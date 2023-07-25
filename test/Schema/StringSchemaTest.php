<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Test\Schema;


use PHPUnit\Framework\TestCase;
use Wepesi\App\Schema\StringSchema;

class StringSchemaTest extends TestCase
{
    private string $stringSchema = 'Wepesi\\App\\Schema\\StringSchema';
    /**
     * @return void
     */
    public function testStringIsObject()
    {
        $stringSchema = new StringSchema();
        $this->assertIsObject($stringSchema);
    }

    /**
     * @return void
     */
    public function testStringObjectIsKey()
    {
        $stringSchema = new StringSchema();
        $this->assertArrayHasKey($this->stringSchema, $stringSchema->generate());
    }

    /**
     * @return void
     */
    public function testStringEmailKey()
    {
        $stringSchema = new StringSchema();
        $subset_array = [$this->stringSchema => ["email" => true]];
        $this->assertEquals($subset_array, $stringSchema->email()->generate());
    }

    /**
     * @return void
     */
    public function testStringURLKey()
    {
        $stringSchema = new StringSchema();
        $subset_array = [$this->stringSchema => ["url" => true]];
        $this->assertEquals($subset_array, $stringSchema->url()->generate());
    }

    /**
     * @return void
     */
    public function testStringMatchKey()
    {
        $stringSchema = new StringSchema();
        $subset_array = [$this->stringSchema => ["match" => 'email']];
        $this->assertEquals($subset_array, $stringSchema->match('email')->generate());
    }

    /**
     * @return void
     */
    public function testStringMinimumKey()
    {
        $stringSchema = new StringSchema();
        $subset_array = [$this->stringSchema => ["min" => 1]];
        $this->assertEquals($subset_array, $stringSchema->min(1)->generate());
    }

    /**
     * @return void
     */
    public function testStringMaximumKey()
    {
        $stringSchema = new StringSchema();
        $subset_array = [$this->stringSchema => ["max" => 10]];
        $this->assertEquals($subset_array, $stringSchema->max(10)->generate());
    }
}