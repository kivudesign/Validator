<?php
    use Wepesi\app\Validate;

    $valid = new Validate();
    $source = [
        "name" => "Wepesi",
        "age" => 13,
        "country" => "DRC",
        "state" => "North Kivu",
        "coty" => "Goma",
        "email"=>"infos@wepesi.com",
        "link"=> "https://github.com/bim-g/wepesi_validation/"
    ];
//    include "./test/required.php";
//    include "./test/minmax.php";
//    include "./test/number.php";
    include "./test/link_email.php";