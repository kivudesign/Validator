<?php

use Wepesi\app\Validate;

include('./class/Validate.php');
    $source=[
        "name"=>"wepesi",
        "age"=>13,
    ];
    $chek=[
        "names"=>[
            "required"=>true
        ]
    ];
    $valid= new Validate();

    $result=$valid->check($source,$chek);

    var_dump($valid->passed());
    var_dump($valid->errors());