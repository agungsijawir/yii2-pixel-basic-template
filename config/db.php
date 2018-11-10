<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=basic_template',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',

    // Schema cache options (for production environment)
    'enableSchemaCache' => (YII_ENV_DEV) ? false : true,
    'schemaCacheDuration' => (YII_ENV_DEV) ? false : 60,
    'schemaCache' => (YII_ENV_DEV) ? '' : 'cache',
];
