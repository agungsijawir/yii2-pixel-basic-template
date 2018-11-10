<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception \yii\web\HttpException  */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1 class="page-404-error-code"><strong><?= $exception->statusCode; ?></strong></h1>
    <h2 class="page-404-subheader">OOPS!</h2>
    <h3 class="page-404-text">
        <?= nl2br(Html::encode($message)) ?>
    </h3>

    <div class="page-404-text">
        <a class="btn btn-default" href="<?= \yii\helpers\Url::to(['/']); ?>"><?= Yii::t('app', 'Kembali ke Halaman Utama'); ?></a>
    </div>

</div>