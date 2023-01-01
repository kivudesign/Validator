<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */
$validate = new \Wepesi\App\Validate();
$schema = new \Wepesi\App\Schema();

$data_source = [
    'birth_day' => '2021-05-23',
    'date_created' => '2021-05-23'
];
$rules=[
        "birth_day" => $schema->date()->min("-18years")->required()->generate(),
        "date_created" => $schema->date()->now()->max("100years")->required()->generate()
    ];
    $validate->check($data_source,$rules);

include_once __DIR__ . '/vardump.php';