<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WorkCategory */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $categories array */
?>

<div class="work-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'title')->textInput(['maxlength' => 512]) ?>

    <?php echo $form->field($model, 'slug')
        ->hint(Yii::t('backend', 'If you\'ll leave this field empty, slug will be generated automatically'))
        ->textInput(['maxlength' => 1024]) ?>

    <!-- SEO fields -->
    <?php if ($model->seofield === null) : ?>

        <div class="form-group">
            <label class="control-label" for="seotitle">SEO title</label>
            <?php echo Html::textInput('seotitle', '', ['maxlength' => 512, 'class' => 'form-control']); ?>
        </div>

        <div class="form-group">
            <label class="control-label" for="seodescription">SEO description</label>
            <?php echo Html::textInput('seodescription', '', ['maxlength' => 512, 'class' => 'form-control']); ?>
        </div>

    <?php else : ?>

        <?php echo $form->field($model->seofield, 'seotitle')->textInput(['maxlength' => true]) ?>

        <?php echo $form->field($model->seofield, 'seodescription')->textInput(['maxlength' => true]) ?>

    <?php endif; ?>
    <!-- End SEO fields -->

    <?php echo $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
