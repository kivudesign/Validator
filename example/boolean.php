<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */
$validate = new \Wepesi\App\Validate();
$schema = new \Wepesi\App\Schema();

$data_source = [
    'status' => false,
    'activated' => ""
];
//define the schema model for validation
    $rules=[
        "status" => $schema->boolean()->required()->max(true)->isValid('TRUE')->generate(),
        "activated" => $schema->boolean()->required()->min(false)->isValid('FALSE')->generate(),
    ];

$validate->check($data_source,$rules);
//    check if the validation passed or not
include_once __DIR__ . '/vardump.php';