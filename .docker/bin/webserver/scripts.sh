#!/bin/sh
# set -e

# Apache gets grumpy about PID files pre-existing
rm -f /usr/local/apache2/logs/httpd.pid

touch /var/log/cron.log
echo "* * * * *   date" >> /etc/crontab


# (crontab -l && echo '* * * * * echo "Hello world" >> /var/log/cron.log') | crontab

cron &

exec /usr/sbin/apachectl -DFOREGROUND -k start

exec php -f /var/www/html/php artisan