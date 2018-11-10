<?php
/**
 * RBAC Configuration
 *
 * Mohon rujuk ke halaman
 * https://www.yiiframework.com/doc/guide/2.0/en/security-authorization
 */
return [
    'class' => 'yii\rbac\DbManager',
    'defaultRoles' => ['guest', 'user', 'admin'],
    // uncomment if you want to cache RBAC items hierarchy
    'cache' => 'cache',

];