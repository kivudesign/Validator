<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */
/**
 * Validate string
 */
$rules = [
    "name" => $schema->string()->email()->min(35)->max(50)->required()->generate(),
    "country" => $schema->string()->min(3)->max(40)->generate(),
    "password" => $schema->string()->min(3)->max(40)->generate(),
    "n_password" => $schema->string()->min(3)->max(40)->match("password")->generate(),
];
 var_dump($rules);
//$valid->check($source, $rules);
////    check if the validation passed or not
//var_dump($valid->passed());
//var_dump($valid->errors());