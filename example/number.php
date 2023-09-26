<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

use Wepesi\App\Schema;
use Wepesi\App\Validate;

$validate = new Validate();
$schema = new Schema();
$data_source_pass = [
    "age" => 10,
    "length" => 3,
    "height" => 10,
    "level" => -10,
];

$data_source_fail = [
    "age" => 20,
    "length" => 0,
    "height" => -35,
    "level" => 10,
];
$rules = [
    "age" => $schema->number()->min(8)->max(15)->required(),
    "length" => $schema->number()->min(1)->max(10),
    "height" => $schema->number()->positive(),
    "level" => $schema->number()->negative(),
];
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