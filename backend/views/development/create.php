<?php
/* @var $this yii\web\View */
/* @var $model common\models\Development */
/* @var $categories common\models\DevelopmentCategory[] */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Development',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Developments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="development-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

</div>
