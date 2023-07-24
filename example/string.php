<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */
/**
 * Validate string
 */

use Wepesi\App\Schema;
use Wepesi\App\Validate;

$schema = new Schema();
$validate = new Validate();
$source = [
    'name' => 'ibrahim',
    'country' => "",
    'password' => '1234567',
    'new_password' => 123456,
    'email' => 'infos@wepesi.com',
    'link' => 'https://github.com/bim-g/wepesi_validation/',
    'ip' => '192.168',
];
$rules = [
    "name" => $schema->string()->email()->min(35)->max(50)->required()->generate(),
    "country" => $schema->string()->min(30)->max(40)->required()->generate(),
    "password" => $schema->string()->min(3)->max(40)->generate(),
    "new_password" => $schema->string()->min(3)->max(40)->match("password")->generate(),
    "email" => $schema->string()->min(3)->max(40)->email()->generate(),
    "link" => $schema->string()->min(3)->max(40)->url()->generate(),
    "ip" => $schema->string()->addressIp()->max(40)->url()->generate(),

];
$validate->check($source, $rules);
////    check if the validation passed or not
include_once __DIR__."/vardump.php";