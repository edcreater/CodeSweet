<?php
use yii\helpers\Html;

/*
@var $this \yii\web\View */
/* @var $content string */

\frontend\assets\FrontendAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language; ?>">
<head>
    <meta charset="<?php echo Yii::$app->charset; ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="google-site-verification" content="y6i4FvC23p1Fj7D8FXBAjj8NLvFwNFQtWl6cFR3zIM8" />
    <meta name='yandex-verification' content='629a37a0e9b3d162' />
    <meta name="webmoney" content="EB02B9BF-70BD-43FD-A580-D03251AED6AF"/>

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo \Yii::$app->request->BaseUrl; ?>/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo \Yii::$app->request->BaseUrl; ?>/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo \Yii::$app->request->BaseUrl; ?>/favicons/favicon-16x16.png">
    <link rel="manifest" href="<?php echo \Yii::$app->request->BaseUrl; ?>/favicons/site.webmanifest">
    <link rel="mask-icon" href="<?php echo \Yii::$app->request->BaseUrl; ?>/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <title><?php echo Html::encode($this->title); ?></title>
    <?php $this->head(); ?>
    <?php echo Html::csrfMetaTags(); ?>

</head>
<body>
<?php $this->beginBody(); ?>
    <?php echo $content; ?>
<?php $this->endBody(); ?>

<?php require Yii::getAlias('@frontend/web/images/default.svg'); ?>
</body>
</html>
<?php $this->endPage(); ?>
