<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use common\assets\Html5shiv;
use yii\bootstrap\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

/**
 * Frontend application asset
 */
class FrontendAsset extends AssetBundle
{

    /**
     * @var string
     */
    public $sourcePath = '@frontend/web/bundle';

    /**
     * @var array
     */
    public $css = [
        // 'css/app.css',
    ];

    /**
     * @var array
     */
    public $js = [
        'https://localhost:8080/app.js',
        // 'js/app.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        YiiAsset::class,
        // BootstrapAsset::class,
        Html5shiv::class,
    ];
}
