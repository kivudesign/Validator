<?php
    $schema=[
        "birth_day"=>$valid->date("birth_day")->min("-18years")->required()->check(),
        "date_created"=>$valid->date("birth_day")->now()->max("100years")->required()->check()
    ];
    $valid->check($source,$schema);

    var_dump($valid->passed());
    var_dump($valid->errors());