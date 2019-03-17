#!/bin/bash

composer --no-interaction install

/usr/bin/php /var/www/html/bin/yii migrate-mysql/up --interactive=0
#/var/www/html/bin/yii migrate-mongo/up --interactive=0

/usr/bin/php /var/www/html/bin/yii gii/model-mysql --tableName=* --interactive=0 --overwrite=1
#/var/www/html/bin/yii gii/model-mongo --tableName=* --interactive=0 --overwrite=1

phpenmod xdebug

# This wi
# ll exec the CMD from your Dockerfile, i.e. "npm start"
exec "$@"