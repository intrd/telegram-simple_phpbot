```
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
```
## Installation & updating
```
First install system requiriments 
$ sudo apt-get update & apt-get upgrade
$ sudo apt-get install curl git php5-curl php5-cli
$ curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

Now download and install the package (the Composer automatically download all dependencies)
$ git clone https://github.com/intrd/telegram-simple_phpbot && cd telegram-simple_phpbot
$ composer install

To check for update..
$ composer update
```
## Usage.. sample.php

*TL;DR*: The sample.php file will check every 5s if someone is mentioning the bot @username or talking him in pvt. It process and reply to this chatID based on his message w/ some custom triggers.

### Ten steps to setup your bot..
1. Open Telegram, talk w/ the `http://telegram.me/BotFather`, setup a new Telegram Bot and take a note of your `BotID:Botkey`, something like: `234015785:AAEsvIjg0AcWOINXR0Xt-TGLamuz9k8f10Y`
2. Edit `sample.php` and set your `$botkey`
3. Search on Telegram for yoour `@username_bot` and start a conversation.. 
4. Now run `php sample.php`, it shows what is your `chatID` and set `$debug_chatid` at sample.php.. All your bot activity will be forwarded to this opened chat, for debbugin purpose.
5. Test if your `botID`, `chatID` and `apikey` by doing a HTTP GET request browsing to your bot URL: `https://api.telegram.org/bot<botid>:<botkey>/sendmessage?chat_id=<chatid>&text=hello%20world!` in my sample `https://api.telegram.org/bot234015785:AAEsvIjg0AcWOINXR0Xt-TGLamuz9k8f10Y/sendmessage?chat_id=65628842&text=hello%20world!`, if the bot says `Hello Word!` to you, its ok. PS: group chats use negative chatIDs, `-<chatid>`
6. Change the `$trigger_botname` to your `username_bot` or something you want to trigger your bot replies on groups.  
7. To check if someone is talking w/ your bot every 5 seconds use my `./run.sh` bash daemon sample, or `watch -n5 php sample.php` or setup a cronjob
8. Now put him on a group.. 
9. ![telegram_simple_bot](/telegram_simple_bot.jpg?raw=true "telegram_simple_bot")
10. Test if your bot is replying when you mention his `$trigger_botname`, ask him about `day of week`, say him some of `$bads`, customize `reply_get()` function.

Script this 4 your needs and respect the CC license, thanks!

