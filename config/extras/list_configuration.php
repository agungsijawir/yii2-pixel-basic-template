<?php
return [
    // Group: general
    'general.appName' => [
        'inputOptions' => 'text',
        'label' => Yii::t('app', 'Nama Aplikasi'),
        'rules' => [
            ['required']
        ],
    ],
    'general.subAppName' => [
        'inputOptions' => 'text',
        'label' => Yii::t('app', 'Tag line Aplikasi'),
        'rules' => [],
    ],
    'general.organizationName' => [
        'inputOptions' => 'text',
        'label' => Yii::t('app', 'Nama Organisasi'),
        'rules' => [],
    ],
    'general.nullDisplay' => [
        'path' => 'components.formatter.nullDisplay',
        'inputOptions' => 'text',
        'label' => Yii::t('app', 'HTML Value untuk Null Data'),
        'description' => Yii::t('app', 'HTML value untuk nilai / data yang belum diatur'),
        'rules' => [
            ['required']
        ],
    ],

    // Group: mailer
    'email.Admin' => [
        'inputOptions' => ['type' => 'email'],
        'label' => Yii::t('app', 'Email Administrator'),
        'description' => 'Alamat email Administrator untuk pengiriman notifikasi',
        'rules' => [
            ['required']
        ],
    ],
    'email.EnableSendMail' => [
        'path' => 'components.mailer.useFileTransport',
        'inputOptions' => ['type' => 'checkbox'],
        'label' => Yii::t('app', 'Aktifkan Pengiriman Email?'),
        'rules' => [
            ['required']
        ],
    ],
    'email.ServerSMTP' => [
        'path' => 'components.mailer.transport.host',
        'inputOptions' => ['type' => 'text'],
        'label' => Yii::t('app', 'Pengiriman Server Email (SMTP)'),
        'description' => Yii::t('app', 'Outgoing Mail Server'),
        'rules' => [
            ['required']
        ],
    ],
    'email.ServerSMTPPort' => [
        'path' => 'components.mailer.transport.port',
        'inputOptions' => ['type' => 'text'],
        'label' => Yii::t('app', 'Server Email Port'),
        'description' => Yii::t('app', 'Outgoing Mail Server Port'),
        'rules' => [
            ['required']
        ],
    ],
    'email.ServerSMTPLogin' => [
        'path' => 'components.mailer.transport.username',
        'inputOptions' => ['type' => 'text'],
        'label' => Yii::t('app', 'Username Login'),
        'description' => Yii::t('app', 'Username yang digunakan untuk login ke Mail Server'),
        'rules' => [
            ['required']
        ],
    ],
    'email.ServerSMTPPassword' => [
        'path' => 'components.mailer.transport.password',
        'inputOptions' => ['type' => 'password'],
        'label' => Yii::t('app', 'Password Login'),
        'description' => Yii::t('app', 'Password yang digunakan untuk login ke Mail Server'),
        'rules' => [
            ['required']
        ],
    ],
    'email.ServerSMTPEncryption' => [
        'path' => 'components.mailer.transport.encryption',
        'inputOptions' => ['type' => 'dropDown', 'items' => ['' => 'Tidak Ada', 'tls' => 'TLS - Transport Layer Security']],
        'label' => Yii::t('app', 'Enkripsi Server'),
        'description' => Yii::t('app', 'Keamanan Komunikasi ke Server'),
        'rules' => [],
    ],
];