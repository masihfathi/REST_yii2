<?php
use yii\web\Request;
//use yii\web\Response;
$baseUrl = str_replace('/web', '', (new Request)->getBaseUrl());
$params = require(__DIR__ . '/params.php');
$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'fa-IR',
//     'bootstrap' => [
//            [
//                'class' => 'yii\filters\ContentNegotiator',
//                'formats' => [
//                    'application/json' => Response::FORMAT_JSON,
//                    'application/xml' => Response::FORMAT_XML,
//                ],
//                'languages' => [
//                    'en-US',
//                    'fa-IR',
//                ],
//            ],
//        ],    
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'itemTable' => 'rbac_item',
            'itemChildTable' => 'rbac_item_child',
            'assignmentTable' => 'rbac_assignment',
            'ruleTable' => 'rbac_rule',
            'defaultRoles' => ['admin','author'],
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [
                        YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js',
                    ],
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'p2',
            'baseUrl' => $baseUrl,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'masih' => [
          'class' => 'app\components\Debug',
          'type' => 'info',
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
        'user' => [
            'identityClass' => 'app\models\Users',
            'on '.\yii\web\User::EVENT_AFTER_LOGIN => ['app\models\Users', 'handleAfterLogin'],
            'on '.\yii\web\User::EVENT_AFTER_LOGOUT => ['app\models\Users', 'handleAfterLogout'],
            'enableAutoLogin' => true,
        ],        
        'urlManager' => [
          'baseUrl' => $baseUrl,
        'enablePrettyUrl' => true,
//        'enableStrictParsing' => true,
        'showScriptName' => false,
          'rules' => [
                ['class'=>'yii\rest\UrlRule','controller'=>'user,testrest'],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'country',  
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ]
                ]              
//                ['<controller>/test/<message>' => 'site/test','<action>'=>'site/<action>']
            ],
        ],
        'i18n'=>[
            'translations'=>[
                'app*'=>[
                    'class'=>'yii\i18n\PhpMessageSource',
                    'basePath'=>'@app/messages',
                    'sourceLanguage'=>'ru',
                    'fileMap'=>[
                        'app'=>'app.php',
                        'app/error'=>'error.php',
                    ],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),

    ],
    'params' => $params,
    'modules' => [
        'forum' => 'app\modules\forum\Module',
        'admin' => 'app\modules\admin\AdminModule',
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
