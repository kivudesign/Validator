<?php
$check=[
    "password"=>[
        "required"=>true,
        "matches"=> "n_password",
        "min"=>-1,
        "max"=>3
    ]
    ];
$valid->check($source, $check);
var_dump($valid->passed());
var_dump($valid->errors());