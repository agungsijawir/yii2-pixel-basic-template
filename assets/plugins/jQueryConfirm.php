<?php
/**
 * jQuery Confirm Asset Bundles
 * For more information, please visit: https://craftpip.github.io/jquery-confirm/
 */
namespace app\assets\plugins;

use yii\web\AssetBundle;

class jQueryConfirm extends AssetBundle
{
    public $sourcePath = '@webroot/plugins/jquery-confirm';
    public $basePath = '@webroot/plugins/jquery-confirm';
    public $baseUrl = '@web/plugins/jquery-confirm';
    public $css = [
        'jquery-confirm.min.css',
    ];
    public $js = [
        'jquery-confirm.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}