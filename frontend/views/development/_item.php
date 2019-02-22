<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\Development
 */
use yii\helpers\Html;

?>

<div class="developments-list__item developments-list-item">
    <div class="developments-list-item__inner">

        <div class="developments-list-item__thumb">
		    <?php if ($model->thumbnail_path): ?>
			    <?php $thumb = Html::img(
				    Yii::getAlias('@storageUrl') . '/thumbs/' . $model->thumbnail_path,
				    /*Yii::$app->glide->createSignedUrl([
					    'glide/index',
					    'path' => $model->thumbnail_path,
					    'w' => 460,
                        'h' => 320,
                        'fit' => 'crop'
				    ], true),*/
				    ['class' => 'img-fluid']
			    ) ?>
			    <?php echo Html::a($thumb, ['view', 'category'=>$model->category->slug, 'slug'=>$model->slug]) ?>
		    <?php endif; ?>
        </div>

        <div class="developments-list-item__content">

            <div class="developments-list-item__meta developments-list-meta">
                <div class="developments-list-meta__item">
                    <span class="developments-list-meta__ico">
                        <i class="far fa-calendar"></i>
                    </span>
                    <span class="developments-list-meta__label">
                        <?php echo Yii::$app->formatter->asDate($model->created_at) ?>
                    </span>
                </div>
                <div class="developments-list-meta__item">
                   <span class="developments-list-meta__ico">
                        <i class="far fa-newspaper"></i>
                    </span>
                    <span class="developments-list-meta__label">
                    <?php echo Html::a(
                        $model->category->title,
                        ['index', 'DevelopmentSearch[category_id]' => $model->category_id]
                    )?>
                    </span>
                </div>
            </div>

            <div class="developments-list-item__heading">
                <h2 class="developments-list-item__title"><?php echo $model->title; ?></h2>
                <p class="developments-list-item__subtitle"><?php echo $model->subtitle; ?></p>
            </div>

            <div class="developments-list-item__buttons">
                <a href="#" class="btn btn--primary">Подробности</a>
            </div>

        </div>
    </div>
</div>
