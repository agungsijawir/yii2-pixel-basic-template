<?php
namespace app\assets\plugins;
use yii\web\AssetBundle;

/**
 * Class PixelAdminFonts
 *
 * @package app\assets\plugins
 */
class PixelAdminFonts extends AssetBundle
{
    public $css = [
        '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin',
        '//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
        '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'
    ];
    public $depends = [
        'yii\web\YiiAsset'
    ];
    public $cssOptions = [
        'rel' => 'stylesheet',
        'crossorigin' => 'anonymous'
    ];
}