<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

namespace Test\Script;
use Exception;
use PHPUnit\Framework\TestCase;
use Wepesi\App\Validator\StringValidator;

/**
 * String validation test
 */
class StringValidationTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testStringValidationSourceDataException(){
        $stringValidationSourceDataException = Exception::class;
        try {
            $stringValidationSourceDataException = new StringValidator("","");
        }catch (Exception $ex){
            $className = get_class($ex);
            $msg = $ex->getMessage();
            $code = $ex->getCode();
        }

        $expectedMessage = 'Your Source Data should not be en empty array';
        $expectedCode = 0;
        $this->assertSame($stringValidationSourceDataException,$className);
        $this->assertSame($expectedMessage,$msg);
        $this->assertSame($expectedCode,$code);
    }
    public function testStringValidationSchemaException(){
        $stringValidationSchemaException= Exception::class;
        try {
            $source=["name"=>"john Doe"];
            $stringValidationSchemaException = new StringValidator($source, []);
        }catch (Exception $ex){
            $className = get_class($ex);
            $msg = $ex->getMessage();
            $code = $ex->getCode();
        }

        $expectedMessage = 'Your Schema should not be en empty array';
        $expectedCode = 0;
        $this->assertSame($stringValidationSchemaException,$className);
        $this->assertSame($expectedMessage,$msg);
        $this->assertSame($expectedCode,$code);
    }
    public function testStringValidationFieldNotDefinedException(){
        $stringValidationSchemaException= Exception::class;
        try {
            $source=["name"=>"john Doe"];
            $schema=["names"=>[
                "string"=>[
                    "required"=>false
                ]
            ]];
            $stringValidationSchemaException = new StringValidator($source, $schema);
        }catch (Exception $ex){
            $className = get_class($ex);
            $msg = $ex->getMessage();
            $code = $ex->getCode();
        }

        $expectedMessage = 'field not defined';
        $expectedCode = 0;
        $this->assertSame($stringValidationSchemaException,$className);
        $this->assertSame($expectedMessage,$msg);
        $this->assertSame($expectedCode,$code);
    }
    /**
     * @throws Exception
     */
    public function testStringIsObject(){
        $source = ['name' => 'John Doe'];
        $schema = [
            'name' => [
                'String' => [
                    'min' => 150
                ]
            ]
        ];
        $stringValidation= new StringValidator($source,$schema);
        $this->assertIsObject($stringValidation);
    }
    /**
     * @throws Exception
     */
    public function testStringMinError(){
        $source=["name"=>"John Doe"];
        $schema=[
            'name'=>[
                'String'=>[
                    'min'=>150
                ]
            ]
        ];
        $stringValidation= new StringValidator($source,$schema);
        $error[]=[
            'type'=>'string.min',
            'message'=>'`name` should have minimum of `150` characters',
            'label'=>'name',
            'limit'=>150
        ];
        $this->assertEquals($stringValidation->result(150),$error);
    }

    /**
     * @throws Exception
     */
    public function testStringMinSuccess(){
        $source=["name"=>"John Doe"];
        $schema=[
            'name'=>[
                'String'=>[
                    'min'=>5
                ]
            ]
        ];
        $stringValidation= new StringValidator($source,$schema);
        $this->assertEmpty($stringValidation->result());
    }/**
     * @throws Exception
     */
    public function testStringMaxError(){
        $source=["description"=>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores assumenda at, dolorem dolores error harum laudantium magnam qui quisquam sapiente sequi unde, voluptatum. At illo nesciunt obcaecati, odit omnis repellendus!
"];
        $schema=[
            'description'=>[
                'String'=>[
                    'max'=>150
                ]
            ]
        ];
        $stringValidation= new StringValidator($source,$schema);
        $error[]=[
            'type'=>'string.max',
            'message'=>'`description` should have maximum of `150` characters',
            'label'=>'description',
            'limit'=>150
        ];
        $this->assertEquals($stringValidation->result(150),$error);
    }

    /**
     * @throws Exception
     */
    public function testStringMaxSuccess(){
        $source=["description"=>"Lorem ipsum dolor sit amet."];
        $schema=[
            'description'=>[
                'String'=>[
                    'max'=>50
                ]
            ]
        ];
        $stringValidation= new StringValidator($source,$schema);
        $this->assertEmpty($stringValidation->result());
    }/**
     * @throws Exception
     */
    public function testStringEmailError(){
        $source=["email"=>"John@Doe"];
        $schema=[
            'email'=>[
                'String'=>[
                    'email'=>true
                ]
            ]
        ];
        $stringValidation= new StringValidator($source,$schema);
        $error[]=[
            'type'=>'string.email',
            'message'=>'`email` should be an email.',
            'label'=>'email'
        ];
        $this->assertEquals($stringValidation->result(),$error);
    }

    /**
     * @throws Exception
     */
    public function testStringEmailSuccess(){
        $source=["email"=>"John@doe.com"];
        $schema=[
            'email'=>[
                'String'=>[
                    'email'=>true
                ]
            ]
        ];
        $stringValidation= new StringValidator($source,$schema);
        $this->assertEmpty($stringValidation->result());
    }
    /**
    * @throws Exception
    */
    public function testStringURLError(){
        $source=["link"=>"hello.com"];
        $schema=[
            'link'=>[
                'String'=>[
                    'url'=>150
                ]
            ]
        ];
        $stringValidation= new StringValidator($source,$schema);
        $error[]=[
            'type'=>'string.url',
            'message'=>'`link` this should be a link(url)',
            'label'=>'link'
        ];
        $this->assertEquals($stringValidation->result(150),$error);
    }

    /**
     * @throws Exception
     */
    public function testStringURLSuccess(){
        /**
         * supported link : http(s)://[domain].[extension] ,
         * http(s)://www.[domain].[extension],
         * www.[domain].[extension]
         */
        $source=["link"=> "http://wepesi.com"];
        $schema=[
            'link'=>[
                'String'=>[
                    'url'=>true
                ]
            ]
        ];
        $stringValidation= new StringValidator($source,$schema);
        $this->assertEmpty($stringValidation->result());
    }

    /**
     * @throws Exception
     */
    public function testStringRequiredErrorsUnknown()
    {
        $source = ['username' => ' '];
        $schema = [
            'username' => [
                'String' => [
                    'required' => true
                ]
            ]
        ];
        $stringValidation = new StringValidator($source, $schema);
        $error=[
                'type' => 'string.unknown',
                'message' => "`username` should be a string",
                'label' => "username"
        ];
        $this->assertEquals($stringValidation->result()[0],$error);
    }

    /**
     * @throws Exception
     */
    public function testStringRequiredErrors()
    {
        $source = ['username' => ' '];
        $schema = [
            'username' => [
                'String' => [
                    'required' => true
                ]
            ]
        ];
        $stringValidation = new StringValidator($source, $schema);
        $error=[
            'type' => 'string.required',
            'message' => "`username` is required",
            'label' => "username"
        ];
        $this->assertEquals($stringValidation->result()[1],$error);
    }

    /**
     * @throws Exception
     */
    public function testStringRequiredSuccess()
    {
        $source = ['username' => 'JonDoe'];
        $schema = [
            'username' => [
                'String' => [
                    'required' => true
                ]
            ]
        ];
        $stringValidation = new StringValidator($source, $schema);
        $this->assertEmpty($stringValidation->result());
    }

    /**
     * @throws Exception
     */
    public function testStringMatchErrors()
    {
        $source = [
            'password' => 'passwrd',
            'retape_password' => 'password',
        ];
        $schema = [
            'password' => [
                'String' => [
                    'match' => 'retape_password'
                ]
            ]
        ];
        $stringValidation = new StringValidator($source, $schema);
        $error[]=[
            'type' => 'string.match',
            'message' => "`password` should match `retape_password`",
            'label' => "password"
        ];
        $this->assertEquals($stringValidation->result(),$error);
    }

    /**
     * @throws Exception
     */
    public function testStringMatchSuccess()
    {
        $source = [
            'password' => 'password',
            'retape_password' => 'password',
            ];
        $schema = [
            'password' => [
                'String' => [
                    'match' => 'retape_password'
                ]
            ]
        ];
        $stringValidation = new StringValidator($source, $schema);
        $this->assertEmpty($stringValidation->result());
    }
}