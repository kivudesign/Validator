<?php
//define the schema model for validation
    $schema=[
        "status"=>$valid->boolean("status")->required()->check(),        
    ];
    var_dump($schema);
    // $valid->check($source,$schema);
//    check if the validation passed or not
    // var_dump($valid->passed());
    // var_dump($valid->errors());