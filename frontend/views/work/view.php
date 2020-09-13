<?php

use yii\widgets\Breadcrumbs;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Development */

if ($seofields->seotitle) {
    $this->title = $seofields->seotitle;
} else {
    $this->title = $model->title;
}

$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Developments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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

                <div class="sidebar">
                    <div class="sidebar__widget widget">
                        <?php if (!empty($model->workPreviews)): ?>
                            <p class="widget__heading"><?php echo Yii::t('frontend', 'Previews') ?></p>
                            <div class="work-previews">
                                <?php foreach ($model->workPreviews as $preview): ?>
                                <div class="work-previews__item">
                                    <?php $thumb = Html::img(
                                        Yii::$app->glide->createSignedUrl([
                                            'glide/index',
                                            'path' => $preview->path,
                                            'w' => 440,
                                            'h' => 660,
                                            'fit' => 'crop-top'
                                        ], true),
                                        ['class' => 'img-fluid']
                                    ) ?>
                                    <?php echo Html::a($thumb, $preview->base_url . $preview->path, ['data-fancybox' => 'previews']); ?>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
