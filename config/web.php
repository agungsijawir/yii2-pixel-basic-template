<?php
/**
 * Application Configuration file
 */
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$list_access_control = require __DIR__ . '/extras/list_access_control.php';
$list_configuration = require __DIR__ . '/extras/list_configuration.php';
$list_rbac = require __DIR__ . '/extras/list_rbac.php';
$config = [
    'id' => 'basic-template',
    'name' => 'Basic Template',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'configManager'],
    'language' => 'id',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@mdm/admin' => '@vendor/mdmsoft/yii2-admin',
    ],
    'as access' => $list_access_control,
    'components' => [
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => '@web/plugins/jquery'
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => '@web/plugins/bootstrap'
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => '@web/plugins/bootstrap'
                ]
            ],
        ],
        'authManager' => $list_rbac,
        'as access' => [
            'class' => 'mdm\admin\components\AccessControl',
            'allowActions' => [
                'site/*',
                'admin/*',

                // Aksi (action) dari suatu controller yang ada pada daftar di bawah akan dibolehkan untuk
                // diakses oleh siapapun, termasuk `guest`. Jadi, aksi `admin/*` sudah seharusnya tidak
                // boleh masuk dalam daftar ini pada mode lingkungan produksi.
                //
                // Namun, pada tahap awal pengembangan, Anda boleh saja memasukkan aksi tersebut atau
                // aksi lainnya hingga siap untuk disetel dalam RBAC. Jika tidak, Anda akan menemui kesalah
                // 403 saat inisiasi awal CRUD.
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'configManager' => [
            'class' => 'yii2tech\config\Manager',
            'storage' => [
                'class' => 'yii2tech\config\StorageDb',
                'table' => 'configurations' // nama table untuk penyimpanan data
            ],
            'items' => $list_configuration,
        ],
        'db' => $db,
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'decimalSeparator' => ',',
            'thousandSeparator' => '.',
            'nullDisplay' => '<span class="label label-default">Belum Diset</span>',
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
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
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // Setelan awal, kirim semua pesan ke dalam sebuah file.
            // Anda diminta untuk mengubah 'useFileTransport` menjadi `false`
            // dan mengatur `transport` untuk pengiriman surel yang sungguhan.
            'useFileTransport' => true,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => '',
                'username' => '',
                'password' => '',
                'port' => 587,
                'encryption' => '',
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'M9ED1UxmoUa326dfG2ZluC-nkWgl1_hq',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<alias:\w+>' => 'site/<alias>',
            ],
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
    ],
    'modules' => [
        'role-manager' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;