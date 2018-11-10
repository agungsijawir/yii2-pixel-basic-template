<?php

/**
 * Main Layout
 *
 * Digunakan di halaman admin / user.
 *
 * @var $this \yii\web\View
 * @var $content string
 */

use app\assets\PixelAdminAssets;
use app\components\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

PixelAdminAssets::register($this);
/**
 * @var $configManager \yii2tech\config\Manager
 */
$configManager = Yii::$app->get('configManager');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <?php $this->registerCsrfMetaTags() ?>

    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- Nav -->
<nav class="px-nav px-nav-left px-nav-collapse">
    <button type="button" class="px-nav-toggle" data-toggle="px-nav">
        <span class="px-nav-toggle-arrow"></span>
        <span class="navbar-toggle-icon"></span>
        <span class="px-nav-toggle-label font-size-11">HIDE MENU</span>
    </button>

    <?= $this->render('menus/_menu_left'); ?>
</nav>

<!-- Navbar -->

<nav class="navbar px-navbar">
    <div class="navbar-header">
        <?= Html::a($configManager->getItemValue('general.appName'), ['/site/index'], ['class' => 'navbar-brand']); ?>
    </div>

    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#px-navbar-collapse" aria-expanded="false">
        <i class="navbar-toggle-icon"></i>
    </button>

    <div class="collapse navbar-collapse" id="px-navbar-collapse">
        <?= $this->render('menus/_menu_top_left'); ?>
        <?= $this->render('menus/_menu_top_right'); ?>
    </div>
</nav>

<!-- Content -->
<div class="px-content">
    <?= Breadcrumbs::widget([
        'encodeLabels' => false,
        'options' => ['class' => 'breadcrumb page-breadcrumb'],
        'tag' => 'ol',
        'homeLink' => [
          'label' => '<i class="glyphicon glyphicon-home"></i>&nbsp;&nbsp;' . Yii::t('app', 'Beranda'),
          'url' => Url::home(),
        ],
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>

    <div class="page-header">
        <h1><?= $this->title; ?></h1>
    </div>

    <?= $content ?>
</div>

<!-- Footer -->
<footer class="px-footer px-footer-bottom">
    Copyright © <?= date('Y'); ?> <?= $configManager->getItemValue('general.organizationName') ?>. All rights reserved.
</footer>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
