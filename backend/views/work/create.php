<?php
/* @var $this yii\web\View */
/* @var $model common\models\Work */
/* @var $categories common\models\WorkCategory[] */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Work',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Works'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

</div>
