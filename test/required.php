<?php
    $chek = [
        "town" => [
            "required" => true
        ]
        ,
        "city"=>[
            "required"=>true
        ]
    ];

    $result = $valid->check($source, $chek);

    var_dump($valid->passed());
    var_dump($valid->errors());