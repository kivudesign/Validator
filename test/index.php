<?php
    use Wepesi\app\Validate;

    $valid = new Validate();
    $source = [
        "name" => "Wepesi",
        "age" => 13,
        "country" => "DRC",
        "town" => "",
        "coty" => ""
    ];
//    include "./test/required.php";
//    include "./test/minmax.php";
   include "./test/number.php";