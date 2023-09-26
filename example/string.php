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
$source_to_pass = [
    'name' => 'ibrahim',
    'country' => null,
    'password' => '1234567',
    'new_password' => 1234567,
    'email' => 'infos@wepesi.com',
    'link' => 'https://github.com/bim-g/wepesi_validation/',
    'ip' => '127.0.0.1',
];
$source_to_fail = [
    'name' => 'ibrahim',
    'country' => "",
    'password' => '1234567',
    'new_password' => 123456,
    'email' => 'i@w.com',
    'link' => 'google',
    'ip' => '192.168',
];
$rules = [
    "name" => $schema->string()->min(3)->max(50)->required(),
    "country" => $schema->any(),
    "password" => $schema->string()->min(3)->max(40),
    "new_password" => $schema->string()->min(3)->max(40)->match("password"),
    "email" => $schema->string()->min(10)->max(40)->email(),
    "link" => $schema->string()->min(10)->max(45)->url(),
    "ip" => $schema->string()->addressIp()
];

$validate->check($source_to_pass, $rules);
//  validation pass
var_dump([
    'passed' => $validate->passed(),
    'errors' => $validate->errors()
]);

//  validation fail
$validate->check($source_to_fail, $rules);
var_dump([
    'passed' => $validate->passed(),
    'errors' => $validate->errors()
]);