##
# Telegram Simple PHP Bot - A different and simple approach to use Telegram Bot Plataform (No SSL or setWebhook needed)
#
# @package intrd/telegram-simple_phpbot
# @version 1.1
# @tags telegram, bot, eggdrop, php
# @link http://github.com/intrd/telegram-simple_phpbot
# @author intrd (Danilo Salles) - http://dann.com.br
# @copyright (CC-BY-SA-4.0) 2016, intrd
# @license Creative Commons Attribution-ShareAlike 4.0 - http://creativecommons.org/licenses/by-sa/4.0
# Dependencies: 
# - php >=5.3.0
# - intrd/php-common >=1.0.x-dev <dev-master
## @docbloc 1.1

#!/bin/bash
LOGFILE="LOGS/telegrambot.log"
TIMESTAMP=`date "+%Y-%m-%d_%H:%M:%S"`
touch $LOGFILE

while true
do
	echo "$TIMESTAMP STARTING...\n" >> $LOGFILE 
	php sample.php 2>&1 | tee $LOGFILE
	sleep 5
done







