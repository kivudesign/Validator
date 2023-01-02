<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

$validate = new \Wepesi\App\Validate();
$schema = new \Wepesi\App\Schema();
$data_source = [
    "age" => 20,
    "length" => 0,
    "height" =>"35",
    "width" =>"",
    "direction" => -7
];
$rules=[
    "age" => $schema->number()->min(8)->max(15)->required()->generate(),
    "length" => $schema->number()->min(1)->max(10)->required()->generate(),
    "height" => $schema->number()->min(18)->max(50)->required()->generate(),
    "width" => $schema->number()->min(3)->max(50)->required()->generate(),
    "direction" => $schema->number()->min(3)->max(50)->positive()->required()->generate(),
    ];
$validate->check($data_source,$rules);

include_once __DIR__ . '/vardump.php';