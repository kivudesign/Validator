<?php
//define the schema model for validation
    $schema=[
        "name"=>$valid->string("name")->email()->min(35)->max(50)->required()->check(),
        "country"=>$valid->string("country")->min(3)->max(40)->check(),        
        "password"=>$valid->string("password")->min(3)->max(40)->check(),        
        "n_password"=>$valid->string("n_password")->min(3)->max(40)->match("password")->check(),        
    ];
    // var_dump($schema);
    $valid->check($source,$schema);
//    check if the validation passed or not
    var_dump($valid->passed());
    var_dump($valid->errors());