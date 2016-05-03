```
/**
 * Telegram Simple PHP Bot - A different and simple approach to use Telegram Bot Plataform (No SSL or setWebhook needed)
 * 
* @package telegram-simple_phpbot
* @version 1.0
* @category api
* @author intrd - http://dann.com.br/
* @copyright 2015 intrd
* @license private
* @link http://github.com/intrd/telegram-simple_phpbot/
* Dependencies: See README.
*/
```
## Installation
```
apt-get update & apt-get upgrade
apt-get install php5-curl php5-sqlite php5-cli

apt-get install git
git clone http://github.com/intrd/telegram-simple_phpbot

# Dependencies.. 
Stay outside and clone all dependencies below..
git clone https://github.com/intrd/php-common/ 
```
## Directory structure
Follow this sample structure..
```
|_Your_project_directory
 |_index.php //index of your project calling telegram-simple_phpbot when it is need (see sample.php)
 |_telegram-simple_phpbot //this cloned directory
  |_sample.php //sample.php testing/showing how to call functions from instagram-api-nooauth
 |_php-common //depencency
 |_TMP //temp directory

```
## Usage.. sample.php

*TL;DR*: The sample.php file will check every 5s if someone is mentioning the bot @username or talking him in pvt. It process and reply to this chatID based on his message w/ some custom triggers.

### Ten steps to setup your bot..
1. Open Telegram, talk w/ the `http://telegram.me/BotFather` and setup a new Telegram Bot and take a note of your BotID:Botkey, something like: `234015785:AAEsvIjg0AcWOINXR0Xt-TGLamuz9k8f10Y`
2. Edit sample.php and set your $botkey, enable $debug=true too.
3. Search on Telegram for yoour bot @username and start a conversation.. 
4. Now run `php sample.php`, discover what is your chatID and edit $debug_chatid at sample.php.. all your bot activity will be forwarded to this opened chat, for debbugin purpose.
5. Test if your botid, chatid and apíkey is ok doing a GET request browsing to your bot URL: `https://api.telegram.org/bot<botid>:<botkey>/sendmessage?chat_id=<chatid>&text=hello%20world!` in my sample `https://api.telegram.org/bot234015785:AAEsvIjg0AcWOINXR0Xt-TGLamuz9k8f10Y/sendmessage?chat_id=65628842&text=hello%20world!`, if the bot says Hello Word! to you, its ok. (PS: group chats use negative chatIDs, -<chatid>)
```
Http valid response..
{"ok":true,"result":{"message_id":4,"from":{"id":234015785,"first_name":"intrdtest","username":"intrd_bot"},"chat":{"id":2722434,"first_name":"intrd","username":"intrd","type":"private"},"date":1462316228,"text":"hello world!"}}
```
6. Change the $trigger_botname to your bot @username or something you want to trigger your bot replies on groups.  
7. To check if someone is talking w/ your bot every 5 seconds use my `./run.sh` bash daemon, or `watch -n5 php sample.php` or setup a cronjob
9. Now put him on a group.. test if your bot is replying when you mention his $trigger_botname, ask him about "day of week", say him some of $bads, customize reply_get() function.
![telegram_simple_bot](/telegram_simple_bot.jpg?raw=true "telegram_simple_bot")
10. Script this 4 your needs!

