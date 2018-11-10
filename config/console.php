<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$list_rbac = require __DIR__ . '/extras/list_rbac.php';
$list_configuration = require __DIR__ . '/extras/list_configuration.php';
$config = [
    'id' => 'basic-template-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'configManager'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
        'authManager' => $list_rbac,
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
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
