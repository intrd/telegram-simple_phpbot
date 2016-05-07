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

require __DIR__ . '/vendor/autoload.php';
use php\intrdCommons as i;
use telegram\simplePhpBot as b;

$conf = parse_ini_file("config.ini", false);

date_default_timezone_set($conf["timezone"]); 

$conf["root"]=dirname(__FILE__)."/";
i::check_dir(array($conf["root"]."DATA/",$conf["root"]."TMP/",$conf["root"]."LOGS/")); 
$conf["tmp_path"]=$conf["root"]."TMP/";
$conf["data_path"]=$conf["root"]."DATA/";
$conf["cookie_jar_file"]=$conf["tmp_path"].$conf["cookie"];
$conf["replieds"]=$conf["data_path"].$conf["replieds"]; 

/* Sample of a bot that reply custom based on current week day when "day of week" text is mentioned */
$data = date('D');
$weekday_ptbr=i::weekday_ptBR($data);
$ctf_horario["Sun"]="Whazaaaapp??? Sunday is the day of the week following Saturday but before Monday. Know as $weekday_ptbr in pt_BR";
$ctf_horario["Mon"]="Hey.. today is Monday.. Monday is the day of the week between Sunday and Tuesday. pt_BR translated to $weekday_ptbr";
$ctf_horario["Tue"]="Hey... today is Tue..";
$ctf_horario["Wed"]="Yeah today is weed.. ops, Wed.";
$ctf_horario["Thu"]="Hmmm..";
$ctf_horario["Fri"]="TGIF!";
$ctf_horario["Sat"]="SAT! :D";
$custom[$conf["trigger_custom1"]]=$ctf_horario[date('D')]; 

$offset = fopen($conf["replieds"], 'a') or die("Can't create file");fclose($offset);
$offset = file($conf["replieds"]); 
$offset = trim(array_pop($offset));
$updates=b::telegrambot_getUpdates($offset); //get all chats opened w/ bot (channel mentions and pvts)
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
  if ($conf["debug"]) {
    if (isset($message["message"]["chat"]["id"])){
      echo "\n>>> Debug chatID: ".$message["message"]["chat"]["id"];
      echo "\n*** Ok, take a note of your chatID. Now disable debug and set debug_chatid on your config.ini\n\n";
    } 
    die;
  }
  if (isset($message["message"]["text"])){
    $text=$message["message"]["text"]; //get text of a message
    $chat_type=$message["message"]["chat"]["type"]; //chat type = group, private.. 
    if (i::file_checkstring($conf["replieds"],$update_id)!=true){ //check and ignore replieds
      $str_id=1;
      echo $from_chatid.":".$update_id.":".$from.": ".$text."\n"; 
      $reply=b::reply_get($text,$from,$str_id,$pp=false,$custom); //GENERATE A REPLY TEXT BASED ON YOUR TRIGGER AND BAD WORDS, SEE/EDIT reply_get() ON src/classes.php
      if ($chat_type!="private"){
        if (strpos($text,$conf["trigger"]) === false and $pvt==true){
          i::fwrite_a($conf["replieds"],$update_id."\r\n");
          return false;
        }
        $reply=$from." ".$reply;
      }
      echo "replying > $reply"; 
      $reply=urlencode($reply); //encode reply text to use on HTTP POST
      $reply_textbuffer=$reply;
      $reply=b::telegrambot_sendReply($from_chatid,$reply); //POST a reply to group/pvt
      //i::vd($reply); //enable for debuggin
      $httpcode=$reply["header"]["http_code"];
      if($httpcode==200 or $httpcode==403){
        if (isset($conf["debug_chatid"])){
          $replydebug=b::telegrambot_sendReply($conf["debug_chatid"],$from." $text :: $from_chattitle :: ".$reply_textbuffer); //send a reply to debug chatid too..
        }
        i::fwrite_a($conf["replieds"],$update_id."\r\n"); //if ok, stores it to avoid duplicates
      }
    }
  }
}



