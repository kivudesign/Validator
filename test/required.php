<?php

    $chek = [
        "name" => [
            "required" => true
        ]
    ];

    $result = $valid->check($source, $chek);

    var_dump($valid->passed());
    var_dump($valid->errors());