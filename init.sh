service ssh start
service nginx start
service php7.0-fpm start
service cron start
crontab CRONTAB

## mysql
chown -R mysql:mysql mysql
service mysql start

## webconfig
mkdir /var/www/robotics
mkdir /var/www/robotics8080
cp -r assets /var/www/robotics8080/

## copy to web dir
cd element-starter; sh renew.sh
cd ..

## nginx
cp nginx-config/config/robotics nginx-config/config/redirect /etc/nginx/sites-available/
ln -s /etc/nginx/sites-available/robotics /etc/nginx/sites-enabled/robotics
ln -s /etc/nginx/sites-available/redirect /etc/nginx/sites-enabled/redirect
service nginx restart

## vim
cp /search/.vimrc /root/

## start ssh hosting
cd WebSSH2; npm start;
