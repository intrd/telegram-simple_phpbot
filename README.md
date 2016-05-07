```
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
```
## Installation & updating
```
Install system requiriments 
$ sudo apt-get update & apt-get upgrade
$ sudo apt-get install curl git php5-curl php5-cli
$ curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

Now download the package (Composer automatically install all dependencies)
$ git clone https://github.com/intrd/telegram-simple_phpbot && cd telegram-simple_phpbot
$ composer install

To check for update..
$ composer update
```
## Usage.. sample.php

*TL;DR*: The sample.php file will check every 5s if someone is mentioning the bot @username or talking him in pvt. It process and reply based on his message w/ some custom triggers.

### Steps to setup your bot.
1. Open Telegram, talk w/ the `http://telegram.me/BotFather`, setup a new Telegram Bot and take a note of your `BotID:Botkey`, something like: `234015785:AAEsvIjg0AcWOINXR0Xt-TGLamuz9k8f10Y`
2. Edit `config.ini` and set your `botkey`
3. Search on Telegram for your `@username_bot` and start a conversation.. 
4. Now run `php sample.php`, it shows your `chatID`. Set `debug_chatid` on `config.ini`. All bot activity will be forwarded to this conversation, for debbugin purpose.
5. Change the `trigger` to your `username_bot` or something you want to trigger your bot replies on groups.  
6. To check if someone is talking w/ your bot every 5 seconds use my bash daemon sample `./run.sh &`, or `watch -n5 php sample.php` or setup a cronjob
7. Now put him on a group.. 
8. Test if your bot is replying when you mention his `trigger`, ask him about `day of week`, say him some of `$bads`, customize `reply_get()` function.

![telegram_simple_bot](/imgs/telegram_simple_bot.jpg?raw=true "telegram_simple_bot")

If you need manually check (botid/botkey/chatid), just browse to your bot URL: `https://api.telegram.org/bot<botid>:<botkey>/sendmessage?chat_id=<chatid>&text=hello%20world!` in my sample `https://api.telegram.org/bot234015785:AAEsvIjg0AcWOINXR0Xt-TGLamuz9k8f10Y/sendmessage?chat_id=65628842&text=hello%20world!`, if the bot says `Hello World!` to you, its ok. PS: group chats use negative chatIDs, `-<chatid>`

Script this 4 your needs and respect the CC license, thanks!

