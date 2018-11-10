<?php

use app\components\widgets\NavTop;

echo NavTop::widget([
        'options' => ['class' => 'nav navbar-nav navbar-top-menu'],
        'encodeLabels' => false,
        'items' => [
            // Contoh menu tanpa sub-menu
            ['label' => '<i class="glyphicon glyphicon-home"></i> Home', 'url' => ['/site/index']],
            // Contoh menu standar
            [
                'label' => 'Site Menu',
                'items' => [
                    ['label' => 'About Apps', 'url' => ['/site/about']],
                    ['label' => 'Contact Us', 'url' => ['/site/contact']],
                    ['label' => 'Configuration', 'url' => ['/app-configuration/index'], 'visible' => Yii::$app->authManager->checkAccess(YiI::$app->user->getId(), '/app-configuration/*')],
                ],
            ],
            // Contoh menu multi-column
            [
                'label' => 'Categories',
                'dropDownOptions' => ['class' => 'dropdown-menu dropdown-column col-md-4'],
                'dropDownMultiColumn' => true,
                'items' => [
                    [
                        '<li class="dropdown-header">Business A</li>',
                        ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
                        ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
                        ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
                    ],
                    [
                        '<li class="dropdown-header">Business B</li>',
                        ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
                        ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
                        ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
                    ],
                    [
                        '<li class="dropdown-header">Business C</li>',
                        ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
                        ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
                        ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
                    ]
                ]
            ],
            // Contoh menu dengan sub-sub-menu
            [
                'label' => '<i class="fa fa-bookmark m-r-1"></i>Links',
                'dropDownOptions' => ['class' => 'dropdown-menu'], // dropdown-column
                'items' => [
                    '<li class="dropdown-header">Links A</li>',
                    [
                        'label' => 'Products', 'options' => ['class' => 'dropdown-toggle'], 'items' => [
                            ['label' => 'All', 'url' => '#'],
                            ['label' => 'Popular', 'url' => '#'],
                            ['label' => 'Recent', 'url' => '#'],
                            ['label' => 'Featured', 'url' => '#'],
                            '<li class="divider"></li>',
                            ['label' => '<i class="fa fa-plus m-r-1"></i>Add product', 'url' => '#'],
                        ]
                    ],
                    [
                        'label' => 'Users', 'options' => ['class' => 'dropdown-toggle'],'items' => [
                        ['label' => 'All', 'url' => '#'],
                        ['label' => 'Popular', 'url' => '#'],
                        ['label' => 'Recent', 'url' => '#'],
                        ['label' => 'Featured', 'url' => '#'],
                        '<li class="divider"></li>',
                        ['label' => '<i class="fa fa-plus m-r-1"></i>Add product', 'url' => '#'],
                    ]
                    ],
                    [
                        'label' => 'Blog', 'options' => ['class' => 'dropdown-toggle'],'items' => [
                        ['label' => 'All', 'url' => '#'],
                        ['label' => 'Popular', 'url' => '#'],
                        ['label' => 'Recent', 'url' => '#'],
                        ['label' => 'Featured', 'url' => '#'],
                        '<li class="divider"></li>',
                        ['label' => '<i class="fa fa-plus m-r-1"></i>Add product', 'url' => '#'],
                    ]
                    ],
                    '<li class="divider"></li>',
                    ['label' => 'Overview', 'url' => '#'],
                ]
            ]
        ],
    ]
);
