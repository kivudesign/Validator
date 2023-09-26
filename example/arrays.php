<?php
/*
 * Copyright (c) 2023.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

use Wepesi\App\Schema;
use Wepesi\App\Validate;

$schema = new Schema();
$validate = new Validate();
$data_source_pass = [
    "family" => [
        "children" => 3,
        "children_name" => ['alfa', 'beta', 'omega'],
        "children_age" => [12, 9, 3],
        "location" => [
            "goma" => "Q.Virunga 08",
            "bukabu" => "Bagira 10"
        ]
    ]
];
$data_source_fail = [
    "family" => [
        "children" => 3,
        "children_name" => ['alfa', 3, 'blue'],
        "children_age" => [12, '6.2', 'rachel'],
        "location" => [
            "goma" => "goma",
            "bukabu" => "Bagira",
            "kinshasa" => "Gombe ",
            "Lubumbashi" => "lushi"
        ]
    ]
];

$rules = [
    "family" => $schema->array()->min(1)->max(20)->required()->structure([
        "children" => $schema->number()->positive()->min(1)->max(5)->required(),
        'children_name' => $schema->array()->string(),
        'children_age' => $schema->array()->number(),
        "location" => $schema->array()->min(2)->max(3)->structure([
            "goma" => $schema->string(),
            "bukabu" => $schema->string(),
            "kinshasa" => $schema->any(),
            "Lubumbashi" => $schema->any(),
        ])
    ])
];

//    check if the validation passed or not
$validate->check($data_source_pass, $rules);
var_dump([
    'passed' => $validate->passed(),
    'errors' => $validate->errors()
]);

$validate->check($data_source_fail, $rules);
var_dump([
    'passed' => $validate->passed(),
    'errors' => $validate->errors()
]);