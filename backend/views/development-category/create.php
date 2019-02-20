<?php
/* @var $this yii\web\View */
/* @var $model common\models\DevelopmentCategory */
/* @var $categories common\models\DevelopmentCategory[] */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Development Category',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Development Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="development-category-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

</div>
