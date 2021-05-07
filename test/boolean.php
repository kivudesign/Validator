<?php
//define the schema model for validation
    $schema=[
        "status"=>$valid->boolean("status")->required()->isValid('TRUE')->check(),        
    ];
    
    $valid->check($source,$schema);
//    check if the validation passed or not
    var_dump($valid->passed());
    var_dump($valid->errors());