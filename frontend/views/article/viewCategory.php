<?php
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model common\models\Article */

if ($seofields->seotitle) {
    $this->title = $seofields->seotitle;
} else {
    $this->title = $model->title;
}

$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="page__heading page-heading">
    <div class="page-heading__inner">

        <div class="container">
            <h1 class="page-heading__title"><?php echo $model->title; ?></h1>
            <p class="page-heading__subtitle"><?php echo $model->subtitle; ?></p>
            <div class="page-heading__breadcrumbs">
                <?php echo Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>
        </div>

    </div>
</section>

<div class="page__content">
    <div class="container">
        <div class="layout">
            <div class="layout__content content">

                <?php echo $model->body ?>

            </div>
        </div>
    </div>
</div>
