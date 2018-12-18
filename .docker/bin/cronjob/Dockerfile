FROM php:7.2-apache

RUN apt-get -y update --fix-missing
RUN apt-get upgrade -y
RUN apt-get -y install cron

RUN touch /var/log/cron.log

RUN (crontab -l ; echo "* * * * * echo "Hello world" >> /var/log/cron.log") | crontab

CMD cron && tail -f /var/log/cron.log
