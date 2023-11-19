<?php

use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model common\models\Article */

/**
 * Seo metatags
 */
if ($seofields->seotitle) {
    $this->title = \Yii::$app->name . ' | ' . $seofields->seotitle;
} else {
    $this->title = \Yii::$app->name . ' | ' . $model->title;
}
if ($seofields->seodescription) {
    $this->registerMetaTag([
        'name'    => 'description',
        'content' => $seofields->seodescription
    ]);
}

$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title;
?>
<section class="page__heading page-heading">
    <div class="container">
        <div class="page-heading__inner">
            <div>
                <h1 class="page-heading__title"><?php echo $model->title; ?></h1>
                <p class="page-heading__subtitle"><?php echo $model->subtitle; ?></p>
                <div class="page-heading__breadcrumbs">
                    <?php echo Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="page__content">
    <div class="container">
        <div class="layout layout--sideright">
            <div class="layout__content content">

                <?php echo $model->body ?>

            </div>

            <div class="layout__sidebar">

                <?php echo $this->render('_sidebar') ?>

            </div>
        </div>
    </div>
</div>
