<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WorkMeta */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
        'modelClass' => 'Work Meta',
    ]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Work Meta Items'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->work->title, 'url' => ['update', 'id' => $model->work->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="work-meta-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
