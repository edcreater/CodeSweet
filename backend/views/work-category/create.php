<?php
/* @var $this yii\web\View */
/* @var $model common\models\WorkCategory */
/* @var $categories common\models\WorkCategory[] */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Work Category',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Work Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-category-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

</div>
