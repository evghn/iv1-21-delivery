<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminLteAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css",
        "https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css",
        "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css",
        "/admin-lte-dist/css/adminlte.css",
        "https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css",
        "https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css",
        "/admin-lte-dist/css/fontawesome.css",
    ];
    public $js = [
        "https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js",
        "https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js",
        // "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js", 
        "/admin-lte-dist/js/adminlte.js",
        "https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js",
        "https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js",
        "https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js",
        "https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js",
        "/admin-lte-dist/js/admin-lte-script.js",

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}
