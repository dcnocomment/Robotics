npm run build
test -d /var/www/robotics
if [ $? -ne 0 ]; then
    mkdir /var/www/robotics
fi

rm -rf /var/www/robotics/*

cp dist/* /var/www/robotics/
cp -r src/php/* /var/www/robotics/
cp -r src/assets /var/www/robotics/
cp -r api /var/www/robotics/
