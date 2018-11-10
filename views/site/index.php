<?php
/**
 * @var $this yii\web\View
 * @var $configManager \yii2tech\config\Manager
 */
$configManager = Yii::$app->get('configManager');
$this->title = $configManager->getItemValue('general.appName');
?>
<div class="site-index">
    <div class="row">

        <div class="col-xs-12 width-md-auto width-lg-auto width-xl-auto pull-md-left">
            <a href="#" class="btn btn-primary btn-block"><span class="btn-label-icon left ion-plus-round"></span><?= Yii::t('app', 'Buat Penjualan Baru'); ?></a>
        </div>
        <div class="m-b-2 visible-xs visible-sm clearfix"></div>
        <form action="" class="page-header-form col-xs-12 col-md-4 pull-md-right">
            <div class="input-group">
                <span class="input-group-addon b-a-0 font-size-16"><i class="ion-search"></i></span>
                <input type="text" placeholder="Search..." class="form-control p-l-1 b-a-0">
            </div>
        </form>
    </div>
</div>
