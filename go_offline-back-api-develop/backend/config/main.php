<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'user-management' => [
            'class' => 'webvimark\modules\UserManagement\UserManagementModule',
        ],
        'v1' => [
            'basePath' => '@backend/modules/v1',
            'class' => 'backend\modules\v1\Module'
        ],
        //---------------------------------//
    ],
    'components' => [
        'user' => [
            //'identityClass' => 'common\models\User', // User must implement the IdentityInterface
            'identityClass' => 'backend\modules\v1\models\User', // User must implement the IdentityInterface
            'enableAutoLogin' => false,
            'enableSession' => false,
            'loginUrl' => null
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',

            ],
            'enableCsrfValidation' => false,
            'enableCookieValidation' => false,

        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'pluralize' => false,
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['v1/user'],
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                    // 'except' => ['delete', 'create', 'update', 'index'],
                    'extraPatterns' => [
                        'POST get-own-login-logs' => 'get-own-login-logs',
                    ],
                ],
                [
                    'pluralize' => false,
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['v1/site'],
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                    'extraPatterns' => [
                        'POST login' => 'login',
                        'GET getsusers' => 'getsusers',
                        'GET logout' => 'logout',
                    ],
                ],
                [
                    'pluralize' => false,
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['v1/careersubject'],
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                    'extraPatterns' => [
                    ],
                ],
                [
                    'pluralize' => false,
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['v1/pensum'],
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                    'extraPatterns' => [
                    ],
                ],
                [
                    'pluralize' => false,
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['v1/geodata'],
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                    'extraPatterns' => [
                        'POST savegeo' => 'savegeo',
                    ],
                ],
                [
                    'pluralize' => false,
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['v1/academic'],
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                    'extraPatterns' => [
                        'POST get-user-period' => 'get-user-period',
                        'POST get-pensum-assigned' => 'get-pensum-assigned',
                        'POST get-topics' => 'get-topics',
                        'POST get-questionaire' => 'get-questionaire',
                        'POST post-answer' => 'post-answer',
                        'POST get-pensum-assigned-by-day' => 'get-pensum-assigned-by-day',
                    ],
                ],
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params' => $params,
];
