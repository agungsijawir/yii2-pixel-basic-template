<?php

/**
 * Error Layout
 *
 * @var $this \yii\web\View
 * @var $content string
 */

use app\assets\PixelAdminErrorAssets;
use yii\helpers\Html;
use yii\helpers\Url;

PixelAdminErrorAssets::register($this);
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
<body>
<div class="page-404-bg bg-warning"></div>
<div class="page-404-header bg-white">
    <a class="px-demo-brand px-demo-brand-lg text-default" href="<?= Url::home(); ?>">
        <span class="px-demo-logo bg-black">
            <span class="px-demo-logo-1"></span>
            <span class="px-demo-logo-2"></span>
            <span class="px-demo-logo-3"></span>
            <span class="px-demo-logo-4"></span>
            <span class="px-demo-logo-5"></span>
            <span class="px-demo-logo-6"></span>
            <span class="px-demo-logo-7"></span>
            <span class="px-demo-logo-8"></span>
            <span class="px-demo-logo-9"></span>
        </span>
        <strong><?= $configManager->getItemValue('general.appName'); ?></strong>
    </a>
</div>

<?= $content; ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
