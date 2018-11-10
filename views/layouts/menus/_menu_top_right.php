<?php
use app\components\widgets\NavTop;
use yii\helpers\Url;
use yii\helpers\Html;
?>

<ul id="menu-navbar-top-right" class="nav navbar-nav navbar-menu-user navbar-right">
    <li class="dropdown">
        <a href="<?= Url::to(['/site/message-notifications']); ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
            <?= Html::img(['/images/notifications/003-alarm-bell-2.png'], ['class' => 'icon-24']); ?>
            <span class="px-navbar-icon-label"><?= Yii::t('app', 'Notifikasi'); ?></span>
            <span class="px-navbar-label label label-danger" id="global-system-notification-count">2</span>
        </a>
        <div class="dropdown-menu p-a-0" style="width: 300px;"> <!-- begin .dropdown-menu -->
            <div id="navbar-messages-notifications" style="max-height: 280px; position: relative;">
                <?php for ($i = 0; $i < 10; $i++): ?>
                <div class="widget-messages-alt-item">
                    <?= Html::img(['/images/notifications/008-email-1.png'], ['class' => 'widget-messages-alt-avatar icon-24']); ?>
                    <a href="#" class="widget-messages-alt-subject text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a>
                    <div class="widget-messages-alt-description">from <a href="#">Robert Jang</a></div>
                    <div class="widget-messages-alt-date">2h ago</div>
                </div>
                <?php endfor; ?>
            <a href="<?= Url::to(['/site/message-notifications']); ?>" class="widget-more-link"><?= Yii::t('app', 'PESAN LAINNYA'); ?></a>
        </div> <!-- / .dropdown-menu -->
    </li>

    <?= NavTop::widget([
        'options' => ['class' => 'nav navbar-nav navbar-top-menu'],
        'encodeLabels' => false,
        'items' => [
            [
                'label' => Html::img(Yii::$app->user->identity->getAvatar(), ['class' => 'px-navbar-image']) .
                           '<span class="hidden-md">' . Yii::$app->user->identity->getFullName() .'</span>' .
                           '<span class="caret"></span>',
                'items' => [
                    ['label' => '<i class="fa fa-user"></i>Profile', 'url' => ['/site/user-profile']],
                    '<li class="divider"></li>',
                    [
                        'label' => '<i class="dropdown-icon fa fa-power-off"></i>Log Out',
                        'url' => '#',
                        'linkOptions' => [
                            'id' => 'btn-menu-logout',
                            'data' => [
                                'url' => Url::to(['/site/logout']),
                                'confirm-title' => Yii::t('app', 'Konfirmasi Log-out'),
                                'confirm-message' => Yii::t('app', 'Apakah Anda yakin hendak Log-out?')
                            ]
                        ],
                    ],
                ]
            ],
        ]
    ]); ?>
</ul>