<?php

$check = [
    'address' => [
        'camelcase' => true
    ]
];

$valid->check($source, $check);

var_dump($valid->passed());
var_dump($valid->errors());