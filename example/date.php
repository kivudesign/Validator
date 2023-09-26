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
    'birth_day' => date('Y-m-d',strtotime('19years + now')),
    'date_created' => date('Y-m-d H:i:s',strtotime('now + 1second'))
];
$data_source_fail = [
    'birth_day' => '2021-05-23',
    'date_created' => '2021-05-23'
];
$rules = [
    'birth_day' => $schema->date()->min("18years")->required()->generate(),
    'date_created' => $schema->date()->now()->max("100years")->required()->generate()
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