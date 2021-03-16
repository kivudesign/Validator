<?php
$check=[
    "password"=>[
        "required"=>true,
        "matches"=> "n_password"
    ]
    ];
$valid->check($source, $check);
var_dump($valid->passed());
var_dump($valid->errors());