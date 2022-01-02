<?php


namespace Wepesi\app;

class i18n
{
    static function translate(string $message,array $data=[]):string{
        $file="./lang/".LANG."/language.php";
        if(!is_file($file) && !file_exists($file)){
            $file="./lang/en/language.php";
        }
        include($file);
        $message_key=$message;
        if(count($data)>0){
            $key_value=!isset($language[$message])?null:$language[$message];
            $message_key=$key_value!=null?vsprintf($key_value,$data):vsprintf($message,$data);
        }
        return  $message_key;
    }
}