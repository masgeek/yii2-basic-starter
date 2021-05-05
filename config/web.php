<?php
Yii::setAlias('@logsfolder', 'logs');
Yii::setAlias('@barcodefolder', 'barcodes');

$params = require_once(__DIR__ . '/params.php');
$db = require_once(__DIR__ . '/db.php');
//$db = require __DIR__ . '/db_test.php';
$session = require_once(__DIR__ . '/session.php');
$log = require_once(__DIR__ . '/logger.php');
$mailer = require_once(__DIR__ . '/mailer.php');
$cache = require_once(__DIR__ . '/cache.php');
$mpesa = require_once(__DIR__ . '/mpesa.php');


$config = [
    'id' => 'app',
    'language' => 'en',
    'timeZone' => 'Africa/Nairobi',
    'name' => 'Rudolf',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'request' => [
            'cookieValidationKey' => 'D47934BCCAO2TROSBDCP230YGNPS0DU2P34,FSGD9FWH23RW=R980RWFWO',
            'enableCsrfValidation' => true,
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@app/themes/adminlte3/views'
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'app\common\models\User',
            'enableAutoLogin' => false
        ],
        'formatter' => [
            'class' => 'app\common\components\MyFormatter',
            'decimalSeparator' => '.',
            'thousandSeparator' => ',',
            'currencyCode' => 'KES',
            'defaultTimeZone' => 'Africa/Nairobi'
        ],
        'cache' => $cache,
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => $mailer,
        'log' => $log,
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
    'as access' => [
        'class' => 'app\common\components\MyAccessControl',
        'allowActions' => [
            'site/logout',
            'call-back/stk',
            'call-back/validate',
            'site/request-password-reset'
        ]
    ],
    'modules' => [

    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
