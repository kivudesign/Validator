<?php

$check = [
    'status' => [
        "boolean" => false,
        "required" => true
    ],
];

$valid->check($source, $check);

var_dump($valid->passed());
var_dump($valid->errors());