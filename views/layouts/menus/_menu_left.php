<?php
use app\components\widgets\NavLeft;

echo NavLeft::widget([
    'options' => ['class' => 'px-nav-content ps-theme-default'],
    'encodeLabels' => false,
    'items' => [
        [
            'label' => '<i class="px-nav-icon ion-home"></i><span class="px-nav-label">' . Yii::t('app', 'Dashboard') . '</span>',
            'url' => ['/site/index'],
        ],
        [
            'label' => '<i class="px-nav-icon ion-erlenmeyer-flask"></i><span class="px-nav-label">Menus</span>',
            'dropDownOptions' => ['class' => 'px-nav-dropdown-menu'],
            'items' => [
                ['label' => 'Level 1 - Dropdown A', 'url' => '#', 'options' => ['class' => 'px-nav-item']],
                '<div class="dropdown-divider"></div>',
                '<div class="dropdown-header">Dropdown Header</div>',
                ['label' => 'Level 1 - Dropdown B', 'url' => '#', 'options' => ['class' => 'px-nav-item']],
            ],
        ],
    ],
]);