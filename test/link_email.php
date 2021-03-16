<?php
$check=[
    "email"=>[
        "required"=>true,
        "min"=>3,
        "max"=>60,
        "url"=>true
    ],
    "link"=>[
        "required"=>true,
        "min"=>6,
        "max"=>20,
        "email"=>true
    ]
];
$valid->check($source, $check);
var_dump($valid->passed());
var_dump($valid->errors());