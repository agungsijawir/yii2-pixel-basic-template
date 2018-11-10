<?php

namespace app\assets;

use yii\web\AssetBundle;
/**
 * Class PixelAdminAssets
 *
 * @package app\assets
 */
class PixelAdminAssets extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // basic themes
        'css/pixeladmin.min.css',
        'css/widgets.min.css',
        'css/themes/candy-blue.min.css',
        'css/site.css',
    ];
    public $js = [
        'plugins/pace/pace.min.js',
        'js/libs/pixeladmin.min.js',
        'js/libs/app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'app\assets\plugins\PixelAdminFonts',
        'app\assets\plugins\jQueryConfirm',
    ];
}