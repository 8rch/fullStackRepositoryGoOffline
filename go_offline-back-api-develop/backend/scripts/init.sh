#!/bin/sh
composer install

echo " Stating auth migrations"
php yii migrate --migrationPath=console/migrations/auth/ --interactive=0
echo " Ended auth migrations"
echo " Starting dirty migrations"
php yii migrate --migrationPath=console/migrations/dirty/ --interactive=0
echo " Ended dirty migrations"

echo " Coping the custom vendor to fix migrations behavior"
cp to-fix-vendor/AbstractItem.php vendor/webvimark/module-user-management/models/rbacDB/AbstractItem.php

/usr/sbin/apache2ctl -D FOREGROUND