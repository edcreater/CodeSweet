<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Development */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Development',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Developments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="development-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
