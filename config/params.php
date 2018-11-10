<?php

$list_default_configurations = require __DIR__ . '/extras/list_default_configurations.php';
$main_params = [
    'adminEmail' => 'admin@example.com',
    'user.passwordResetTokenExpire' => 60 * 60 * 24 * 3, // 3 days

    // parameter dasar lainnya ditempatkan di bawah ini:
];

return \yii\helpers\ArrayHelper::merge($main_params, $list_default_configurations);