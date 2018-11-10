<?php

namespace app\assets;

use yii\web\AssetBundle;
/**
 * Class PixelAdminLoginAssets.php
 *
 * @package app\assets
 */
class PixelAdminLoginAssets extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // basic themes
        'css/pixeladmin.min.css',
        'css/widgets.min.css',
        'css/themes/candy-blue.min.css',
        'css/login.css',
    ];
    public $js = [
        'plugins/pace/pace.min.js',
        'js/libs/pixeladmin.min.js',
        'js/libs/app.js',
        'js/libs/login.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\plugins\PixelAdminFonts',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}