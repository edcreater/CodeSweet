<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\Development
 */
use yii\helpers\Html;

?>
<div class="works-box__item work-box">
    <div class="work-box__inner">
        <div class="work-box__thumb">
            <a href="#" class="work-box__link">
                <?php echo Html::img('@storageUrl/thumbs/' . $model->thumbnail['path']); ?>
            </a>
        </div>
        <div class="work-box__title work-box__title--js">
            <?php echo $model->title; ?>
        </div>
    </div>

</div>
