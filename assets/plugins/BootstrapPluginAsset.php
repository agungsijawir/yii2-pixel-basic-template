<?php
namespace app\assets\plugins;

/**
 * Asset bundle for the Twitter bootstrap css files.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class BootstrapPluginAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@webroot/plugins/bootstrap';
    public $basePath = '@webroot/plugins/bootstrap';
    public $baseUrl = '@web/plugins/bootstrap';
    public $css = [
        'css/bootstrap.css',
    ];
    public $js = [
        'js/bootstrap.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}