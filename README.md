<table>
    <tr>
        <td>Telegram Simple PHP Bot - A different and simple approach to use Telegram Bot Plataform (No SSL or setWebhook needed)</td>
    </tr>
    <tr>
        <th>Package</th>
        <td>intrd/telegram-simple_phpbot</td>
    </tr>
    <tr>
        <th>Version</th>
        <td>1.1</td>
    </tr>
    <tr>
        <th>Tags</th>
        <td>telegram, bot, eggdrop, php </td>
    </tr>
    <tr>
        <th>Project URL</th>
        <td><a href="https://github.com/intrd/telegram-simple_phpbot">https://github.com/intrd/telegram-simple_phpbot</a></td>
     <tr/>
    <tr>
       <th>Author</th>
       <td><a href="http://dann.com.br/">Danilo Salles</a> (<a href="http://twitter.com/intrd">@intrd</a>)</td>
    </tr>
    <tr>
        <th>Copyright</th>
        <td>(CC-BY-SA-4.0) 2016, intrd</td>
    </tr>
    <tr>
        <th>License</th>
        <td><a href="http://creativecommons.org/licenses/by-sa/4.0">Creative Commons Attribution-ShareAlike 4.0</a></td>
    </tr>
    <tr>
        <th>Docbloc</th>
        <td>1.0</td>
    </tr>
    <tr>
        <th>Dependencies</th>
        <td>php >=5.3.0, intrd/php-common >=1.0.x-dev &lt;dev-master</td>
    </tr>
</table>

Installation
============

System requiriments & dependencies

```
$ sudo apt-get update & apt-get upgrade
$ sudo apt-get install curl git php5-curl php5-cli
$ curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

Now download the package (Composer automatically install all dependencies)
$ git clone https://github.com/intrd/telegram-simple_phpbot && cd telegram-simple_phpbot
$ composer install -o

To check for update..
$ git pull && composer update
```
## Usage

*TL;DR*: The sample.php file will check every 5s if someone is mentioning the bot @username or talking him in pvt. It process and reply based on his message w/ some custom triggers.

### Steps to setup your bot
1. Open Telegram, talk w/ the `http://telegram.me/BotFather`, setup a new Telegram Bot and take a note of your `BotID:Botkey`, something like: `234015785:AAEsvIjg0AcWOINXR0Xt-TGLamuz9k8f10Y`
2. Create a copy of configuration file sample `cp config.ini.sample config.ini` 
3. Edit `config.ini` and set your `botkey`
4. Search on Telegram for your `@username_bot` and start a conversation.. 
5. Now run `php sample.php`, it shows your `chatID`. Set `debug_chatid` on `config.ini`. All bot activity will be forwarded to this conversation, for debbugin purpose.
6. Change the `trigger` to your `username_bot` or something you want to trigger your bot replies on groups.  
7. To check if someone is talking w/ your bot every 5 seconds use my bash daemon sample `./run.sh &`, or `watch -n5 php sample.php` or setup a cronjob
8. Now put him on a group.. 
9. Test if your bot is replying when you mention his `trigger`, ask him about `day of week`, say him some of `$bads`, customize `reply_get()` function.

![telegram_simple_bot](/imgs/telegram_simple_bot.jpg?raw=true "telegram_simple_bot")

### Tips 
**Manually check (botid/botkey/chatid)**

Browse to your bot URL: `https://api.telegram.org/bot<botid>:<botkey>/sendmessage?chat_id=<chatid>&text=hello%20world!` in my sample `https://api.telegram.org/bot234015785:AAEsvIjg0AcWOINXR0Xt-TGLamuz9k8f10Y/sendmessage?chat_id=65628842&text=hello%20world!`, if the bot says `Hello World!` to you, its ok. PS: group chats use negative chatIDs, `-<chatid>`

**If you prefer not to use daemons (SSL Webserver)**
With a SSL webserver serving your sample.php, simply setup your hook URL by browsing: <br/>
`https://api.telegram.org/bot<botid>:<botkey>/setWebhook?url=http://yourwebserver/sample.php` <br/> 
..and Telegram server will load this URL every time the bot receive a msg.

That's all, <br/>
Script this 4 your needs and respect the CC license, thanks!

