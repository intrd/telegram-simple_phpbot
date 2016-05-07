<?php
/**
 * Telegram Simple PHP Bot - A different and simple approach to use Telegram Bot Plataform (No SSL or setWebhook needed)
 * 
* @package telegram-simple_phpbot
* @author intrd - http://dann.com.br/
* @copyright 2016 intrd
* @license Creative Commons Attribution-ShareAlike 4.0 - http://creativecommons.org/licenses/by-sa/4.0/
* @link http://github.com/intrd/telegram-simple_phpbot/
* Version & Dependencies: See composer.json
*/

namespace telegram;
use php\intrdCommons as i;
class simplePhpBot {

  public function telegrambot_getUpdates($offset){
    global $conf;
    $header=array();
    $url="https://api.telegram.org/bot".$conf["botkey"]."/getUpdates?offset=$offset";
    $updates=i::url_get($url,$conf["cookie_jar_file"],"r",$header,$conf["proxy"],$conf["proxyauth"]);
    return $updates;
  }

  public function telegrambot_sendReply($chatID,$reply){
    global $conf;
    $header=array();
    $url="https://api.telegram.org/bot".$conf["botkey"]."/sendmessage?chat_id=".$chatID."&text=".$reply;
    $updates=i::url_get($url,$conf["cookie_jar_file"],"r",$header,$conf["proxy"],$conf["proxyauth"]);
    i::vd($updates);
    return $updates;
  }

  public function reply_get($text,$screen_name,$str_id,$pp=false,$custom=false){ 
    global $conf;
    $result = $conf["default_reply"];
    foreach ($custom as $key=>$string){
      if (strpos(strtolower($text),strtolower($key))!==false){
        $result = $string;
      }
    }
    $c=0;
    while (preg_match($conf["bad_words"],strtolower($text))){ //if identify some of the $conf["bads"] on text it reply some of these random things.. MELHORAR ESSA FUNCAO PRA IGNORAR..
      $result=strip_tags($i::rem_wrap($text));
      if ($c>=7){
        $rrr=rand(1,4);
        if ($rrr==1) $result="no?";
        if ($rrr==2) $result="no!!!";
        if ($rrr==3) $result="noo...";
        if ($rrr==4) $result="NOOO!";
        break;
      }
      $c++;
    }
    return $result;
  }
}
?>