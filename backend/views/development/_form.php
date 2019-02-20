<?php

use trntv\filekit\widget\Upload;
use trntv\yii\datetime\DateTimeWidget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Development */
/* @var $categories common\models\DevelopmentCategory[] */
/* @var $seotitle common\models\Seofield[] */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="development-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'subtitle')->textInput(['maxlength' => true]) ?>

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

    <?php echo $form->field($model, 'slug')
        ->hint(Yii::t('backend', 'If you\'ll leave this field empty, slug will be generated automatically'))
        ->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(
            $categories,
            'id',
            'title'
        ), ['prompt'=>'']) ?>

	<?php echo $form->field($model, 'body')->widget(
		trntv\aceeditor\AceEditor::className(),
		[
			'mode'  => 'html',
            'theme' => 'xcode'
		]
	) ?>

    <?php echo $form->field($model, 'thumbnail')->widget(
        Upload::className(),
        [
            'url' => ['/development/upload-thumb'],
            'maxFileSize' => 5000000, // 5 MiB
        ]);
    ?>

    <?php echo $form->field($model, 'attachments')->widget(
        Upload::className(),
        [
            'url' => ['/file-storage/upload'],
            'sortable' => true,
            'maxFileSize' => 10000000, // 10 MiB
            'maxNumberOfFiles' => 10
        ]);
    ?>

    <?php echo $form->field($model, 'view')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'status')->checkbox() ?>

    <?php echo $form->field($model, 'published_at')->widget(
        DateTimeWidget::className(),
        [
            'phpDatetimeFormat' => 'yyyy-MM-dd\'T\'HH:mm:ssZZZZZ'
        ]
    ) ?>

    <div class="form-group">
        <?php echo Html::submitButton(
            $model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
