<?php
return [
    'class' => 'mdm\admin\components\AccessControl',
    'allowActions' => [
        'debug/*',
        'gii/*',
        'site/captcha'
    ]
];