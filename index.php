<?php
/*
 * Copyright (c) 2022.  Wepesi validation.
 *  @author Boss Ibrahim Mussa
 */

use Wepesi\App\Validator\StringValidator;

require_once __DIR__."/vendor/autoload.php";
//include __DIR__.'/example/index.php';
try {
    $stringValidationSourceDataException = new StringValidator('');
} catch (Exception $ex) {
    $className = get_class($ex);
    $msg = $ex->getMessage();
    $code = $ex->getCode();
    var_dump($className,
        $msg,
        $code);
}
