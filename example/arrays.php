<?php
/*
 * Copyright (c) 2023.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

use Wepesi\App\Schema;
use Wepesi\App\Validate;

$schema = new Schema();
$validate = new Validate();
$source = [
    "name" =>"wepesi",
    "email" => "info@wepesi.com",
    "children_name" => ["alfa",3,false,"rachel"],
    "possessions" => [
        "cars" => 2,
        "plane" => 0,
        "houses" => 4,
        "children" => -3,
        "location" => [
            "goma" => "Q.Virunga 08",
            "bukabu" => "Bagira 10",
            "kinshasa" => "matadi kibala 05"
        ]
    ]
];

$rules =[
  "name" => $schema->string()->min(1)->max(10)->required()->generate(),
  "email" => $schema->string()->email()->required()->generate(),
  "children_name" => $schema->array()->string()->generate(),
  "possessions" => $schema->array()->min(1)->max(2)->required()->elements([
      "cars" => $schema->number()->min(1)->required()->generate(),
      "plane" => $schema->number()->min(1)->required()->generate(),
      "houses" => $schema->number()->min(6)->required()->generate(),
      "children" => $schema->number()->positive()->required()->generate(),
      "location" => $schema->array()->min(2)->elements([
          "goma" => $schema->string()->min(20)->generate(),
          "bukabu" => $schema->string()->min(20)->generate(),
          "kinshasa" => $schema->string()->min(20)->generate(),
      ])->generate()
  ])->generate()
];

$validate->check($source, $rules);
////    check if the validation passed or not
include_once __DIR__ . '/vardump.php';