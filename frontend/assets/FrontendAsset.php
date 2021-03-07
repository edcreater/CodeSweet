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
	    'css/app.css',
    ];

    /**
     * @var array
     */
    public $js = [
        'js/app.js',
        '//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-604489c4daa6ea82',
    ];

    /**
     * @var array
     */
    public $depends = [
        YiiAsset::class,
        //BootstrapAsset::class,
        Html5shiv::class,
    ];
}
