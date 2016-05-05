<?php
/**
 * Telegram Simple PHP Bot - A different and simple approach to use Telegram Bot Plataform (No SSL or setWebhook needed)
 * 
* @package telegram-simple_phpbot
* @version 1.0
* @author intrd - http://dann.com.br/
* @copyright 2016 intrd
* @license Creative Commons Attribution-ShareAlike 4.0 - http://creativecommons.org/licenses/by-sa/4.0/
* @link http://github.com/intrd/telegram-simple_phpbot/
* Dependencies: See composer.json
*/

function telegrambot_getUpdates($botkey,$offset){
  global $tmp_path, $cookie_jar_file;
  $header=array();
  $cookie_jar_file=$tmp_path."bot";
  $url="https://api.telegram.org/bot$botkey/getUpdates?offset=$offset";
  //echo $url;
  $updates=url_get($url,$cookie_jar_file,"r",$header,$proxy=false,$proxyauth=false,$oauth=false);
  return $updates;
}

function telegrambot_sendReply($botkey,$chatID,$reply){
  global $tmp_path, $cookie_jar_file;
  $header=array();
  $cookie_jar_file=$tmp_path."bot";
  $url="https://api.telegram.org/bot$botkey/sendmessage?chat_id=".$chatID."&text=".$reply;
  //vd($url);
  $updates=url_get($url,$cookie_jar_file,"r",$header,$proxy=false,$proxyauth=false,$oauth=false);
  return $updates;
}

function reply_get($bads,$text,$screen_name,$str_id,$pp=false,$custom=false){ 
  global $default_reply;
  $result = $default_reply;
  foreach ($custom as $key=>$string){
    if (strpos(strtolower($text),strtolower($key))!==false){
      $result = $string;
    }
  }
  $c=0;
  while (preg_match($bads,strtolower($text))){ //if identify some of the $bads on text it reply some of these random things..
    $result=strip_tags(rem_wrap($text));
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

?>