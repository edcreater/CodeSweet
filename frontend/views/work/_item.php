<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\Development
 */
use yii\helpers\Html;

$thumb = Html::img('@storageUrl/thumbs/' . $model->thumbnail['path']);
?>
<div class="works-box__item work-box">
    <div class="work-box__inner">
        <div class="work-box__thumb">
            <?php echo Html::a($thumb, ['view', 'category'=>$model->category->slug, 'slug'=>$model->slug]) ?>
        </div>
        <div class="work-box__title work-box__title--js">
            <?php echo $model->title; ?>
        </div>
    </div>

</div>
