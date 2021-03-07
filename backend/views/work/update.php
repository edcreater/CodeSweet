<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\WorkCategory */
/* @var $categories common\models\Work */
/* @var $workMetaProvider common\models\WorkMeta */

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

    <p></p>
    <p><br><br>Meta fields</p>
    <p>
        <?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
            'modelClass' => 'Work Meta',
        ]), ['/work-meta/create', 'work_id'=>$model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $workMetaProvider,
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [
            'order',
            'key',
            'value',
            'status',

            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => '/work-meta',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>

</div>
