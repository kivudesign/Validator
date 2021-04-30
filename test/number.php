<?php
$check=[
    "age"=>$valid->number("age")->min(18)->max(50)->required()->check()
    ];
    $valid->check($source,$check);
var_dump($valid->passed());
var_dump($valid->errors());