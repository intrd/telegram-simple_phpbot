<?php
/**
 * Telegram Simple PHP Bot - A different and simple approach to use Telegram Bot Plataform (No SSL or setWebhook needed)
 * 
* @package telegram-simple_phpbot
* @version 1.0
* @category api
* @author intrd - http://dann.com.br/
* @copyright 2015 intrd
* @license Creative Commons Attribution-ShareAlike 4.0 - http://creativecommons.org/licenses/by-sa/4.0/
* @link http://github.com/intrd/telegram-simple_phpbot/
* Dependencies: See README.
*/

date_default_timezone_set('America/Sao_Paulo'); //set to your timezone
$debug=false; //disable this after setup your debuggin chatID
$root=dirname(__FILE__)."/";
$ext_path=$root."../";
$tmp_path=$ext_path."TMP/";
require_once($ext_path."php-common/functions.php");
require_once("functions.php");

$botkey="234015785:AAEsvIjg0AcWOINXR0Xt-TGLamuz9k8f10Y"; //Request your with @BotFather (the official telegram bot manager)
$replieds=$root."replieds.txt"; //file to persist replied chats..
$bads = "/(fuck|fodase|meuovo)+/i"; //badwords to be ignored..
$trigger_botname = "intrd_bot"; //word to trigger bot reply action on groups..
$debug_chatid="2722434"; //chatID to debug and monitor all bot activities.. (the chatID of your conversation opened w/ bot)
$default_reply="Yeah im working.. :)";

/* Sample of a bot that reply based on current week day when "day of week" text is mentioned on a text */
$data = date('D');
$weekday_ptbr=$semana["$data"];
$ctf_horario["Sun"]="Whazaaaapp??? Sunday is the day of the week following Saturday but before Monday. Know as $weekday_ptbr in pt_BR";
$ctf_horario["Mon"]="Hey.. today is Monday.. Monday is the day of the week between Sunday and Tuesday. pt_BR translated to $weekday_ptbr";
$ctf_horario["Tue"]="Hey... today is Tue..";
$ctf_horario["Wed"]="Yeah today is weed.. ops, Wed.";
$ctf_horario["Thu"]="Hmmm..";
$ctf_horario["Fri"]="TGIF!";
$ctf_horario["Sat"]="SAT! :D";
/* text to trigger the week day reply function above */
$custom["day of week"]=$ctf_horario[date('D')]; //it will be triggered when the bot is mentioned/pvted and the message contains "day of week"
//vd($custom);

$offset = file($replieds); //load the replied chats
$offset = trim(array_pop($offset));
$updates=telegrambot_getUpdates($botkey,$offset); //get all chats opened w/ bot (channel mentions and pvts)
$last=json_decode($updates["content"], true);
$messages=$last["result"];

$pvt=true;
foreach ($messages as $key=>$message){
  if (isset($message["message"]["from"]["username"]) and strlen($message["message"]["from"]["username"])>=3){
    $from="@".$message["message"]["from"]["username"]; //get the @username
  }else{
    $from=$message["message"]["from"]["first_name"]; //get the First Name if the user has not defined an @username
  }
  $from_chatid=$message["message"]["chat"]["id"]; //get chatID
  $update_id=$message["update_id"];  
  if (isset($message["message"]["chat"]["title"])) $from_chattitle=$message["message"]["chat"]["title"]; //get chat tittle for group name..
  if (isset($message["message"]["chat"]["first_name"])) $from_chattitle=$message["message"]["chat"]["first_name"]; //get chat tittle for private chat..
  if ($debug) {
    vd($message); 
    die("\n **** Ok, take a note of your chat->id, not update_id. Now disable Debug and set chatid on your sample.php\n");
  }
  if (isset($message["message"]["text"])){
    $text=$message["message"]["text"]; //get text of a message
    //vd($text);
    $chat_type=$message["message"]["chat"]["type"]; //chat type = group, private.. 
    if (file_checkstring($replieds,$update_id)!=true){ //check and ignore replieds
      $str_id=1;
      echo $from_chatid.":".$update_id.":".$from.": ".$text."\n"; //just for stdout log purpose
      $reply=reply_get($bads,$text,$from,$str_id,$pp=false,$custom); //GENERATE A REPLY TEXT BASED ON YOUR TRIGGER AND BAD WORDS, SEE/EDIT reply_get() ON functions.php
      if ($chat_type!="private"){
        if (strpos($text,$trigger_botname) === false and $pvt==true){
          fwrite_a($replieds,$update_id."\r\n");
          return false;
        }
        $reply=$from." ".$reply;
      }
      echo "replying > $reply"; //just for stdout log purpose
      $reply=urlencode($reply); //encode to reply to use on HTTP POST
      $reply_textbuffer=$reply;
      $reply=telegrambot_sendReply($botkey,$from_chatid,$reply); //POST a reply to group or pvt chat
      $httpcode=$reply["header"]["http_code"];
      if (isset($debug_chatid)){
        $replydebug=telegrambot_sendReply($botkey,$debug_chatid,$from." ".$text." :: $from_chattitle :: ".$reply_textbuffer); //send a reply to debug chatid too..
      }
      if(1==1 or $httpcode==200 or $httpcode==403){
        fwrite_a($replieds,$update_id."\r\n"); //if ok stores it to avoid duplicates
      }
      
    }
  }
}



