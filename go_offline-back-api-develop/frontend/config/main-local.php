<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'A2yl24g54TKoz8THggCI1AdURXzdzrLj',
        ],
    ],
];
//var_dump($_SERVER['REMOTE_ADDR'])

$allowedIps = ['127.0.0.1', $_SERVER['REMOTE_ADDR']];
// configuration adjustments for 'dev' environment
if (!YII_ENV_PROD) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => $allowedIps,

    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => $allowedIps,
    ];
}
//$config['components']['assetManager']['forceCopy'] = true; // borrar en produccion
return $config;
