<?php
    use Wepesi\app\Validate;
//
    $source = [
        "name" => "",
        "age" => 12,
        "country" => "DRC",
        "state" => "North Kivu",
        "password"=>"1234567",
        "n_password"=>123456,
        "city" => "Goma",
        "email"=>"infos@wepesi.com",
        "link"=> "https://github.com/bim-g/wepesi_validation/",
        "status"=> true
    ];
    $valid=new Validate($source);
    include "./test/string.php";
    include "./test/number.php";
//    include "./test/boolean.php";    