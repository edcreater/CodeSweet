<?php
/** @var $this yii\web\View
 * @var $model common\models\WorkMeta
 * @var $work common\models\Work
 */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Work Meta',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Work Meta Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $work->title, 'url' => ['update', 'id' => $work->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Create');
?>
<div class="work-meta-create">

    <?php echo $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
