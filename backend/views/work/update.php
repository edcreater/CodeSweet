<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Work */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Work',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Works'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="work-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
