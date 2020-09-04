<?php
use yii\web\UrlNormalizer;

return [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'suffix' => '/',
    'normalizer' => [
        'class' => 'yii\web\UrlNormalizer',
        // use temporary redirection instead of permanent for debugging
        'action' => UrlNormalizer::ACTION_REDIRECT_PERMANENT,
        'normalizeTrailingSlash' => true,
    ],
    'rules' => [
        // Pages
        ['pattern' => 'contact', 'route' => 'site/contact', 'suffix' => '/'],
        ['pattern' => 'sitemap.xml', 'route' => 'site/sitemap', 'suffix' => ''],

        // Articles
        ['pattern' => 'blog', 'route' => 'article/index'],
        ['pattern' => 'blog/<category>/', 'route' => 'article/category'],
        ['pattern' => 'blog/<category>/<slug>/', 'route' => 'article/view'],

        // Developments
        ['pattern' => 'developments', 'route' => 'development/index'],
        ['pattern' => 'developments/<category>/', 'route' => 'development/category'],
        ['pattern' => 'developments/<category>/<slug>/', 'route' => 'development/view'],

        // Portfolio
        ['pattern' => 'portfolio', 'route' => 'work/index'],
        ['pattern' => 'portfolio/<category>/', 'route' => 'work/category'],
        ['pattern' => 'portfolio/<category>/<slug>/', 'route' => 'work/view'],

        ['pattern' => '<slug>', 'route' => 'page/view'],

        // Api
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/article', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/user', 'only' => ['index', 'view', 'options']],

    ]
];
