<?php
defined('IP_DB') or define('IP_DB', '192.168.1.10');
defined('IP_PORT') or define('IP_PORT', '2345');

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => "pgsql:host=".IP_DB.";port=".IP_PORT.";dbname=go_offline",
            'username' => 'api_db',
            'password' => 'verysecret',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => true,
        ],
    ],
];

