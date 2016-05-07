#/**
# * Telegram Simple PHP Bot - A different and simple approach to use Telegram Bot Plataform (No SSL or setWebhook needed)
# * 
#* @package telegram-simple_phpbot
#* @author intrd - http://dann.com.br/
#* @copyright 2016 intrd
#* @license Creative Commons Attribution-ShareAlike 4.0 - http://creativecommons.org/licenses/by-sa/4.0/
#* @link http://github.com/intrd/telegram-simple_phpbot/
#* Version & Dependencies: See composer.json
#*/

#!/bin/bash
LOGFILE="LOGS/telegrambot.log"
TIMESTAMP=`date "+%Y-%m-%d_%H:%M:%S"`
touch $LOGFILE

while true
do
	echo "$TIMESTAMP STARTING...\n" >> $LOGFILE 
	php sample.php >> $LOGFILE
	sleep 5
done







