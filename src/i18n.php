<?php


namespace Wepesi\App;

class i18n
{
    private string $lang;

    function __construct(string $lang="en"){
        $this->lang=$lang;
    }
    function translate(string $message,array $data=[]):string{
        $file="./lang/".$this->lang."/language.php";
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
    //TODO add methode that will help to analyse all content off each file and add missing key to the other files to have the same key in all the app.
}