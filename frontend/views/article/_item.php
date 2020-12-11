<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\Article
 */
use yii\helpers\Html;

?>

<div class="blog-grid__item blog-grid-item">
    <div class="blog-grid-item__inner">

        <div class="blog-grid-item__thumb">
            <div class="blog-grid-item__thumb-wrap">
		    <?php if ($model->thumbnail_path): ?>
			    <?php $thumb = Html::img(
				    Yii::$app->glide->createSignedUrl([
					    'glide/index',
					    'path' => $model->thumbnail_path,
                        'sourcePath' => '@storage/web/source',
					    'w' => 460,
                        'h' => 320,
                        'fit' => 'crop'
				    ], true),
				    ['class' => 'img-fluid']
			    ) ?>
			    <?php echo Html::a($thumb, ['view', 'category'=>$model->category->slug, 'slug'=>$model->slug]) ?>
		    <?php endif; ?>
            </div>

        </div>

        <div class="blog-grid-item__content">

            <div class="blog-grid-item__meta blog-grid-meta">
                <div class="blog-grid-meta__item">
                    <span class="blog-grid-meta__ico">
                        <svg class="icon" width="36px" height="36px"><use xlink:href="#icon-calendar"></use></svg>
                    </span>
                    <span class="blog-grid-meta__label">
                        <?php echo Yii::$app->formatter->asDate($model->created_at) ?>
                    </span>
                </div>
                <div class="blog-grid-meta__item">
                   <span class="blog-grid-meta__ico">
                        <svg class="icon" width="36px" height="36px"><use xlink:href="#icon-newspaper"></use></svg>
                    </span>
                    <span class="blog-grid-meta__label">
                    <?php echo Html::a(
                        $model->category->title,
                        ['index', 'ArticleSearch[category_id]' => $model->category_id]
                    )?>
                    </span>
                </div>
            </div>

            <div class="blog-grid-item__heading">
                <h2 class="blog-grid-item__title">
                    <?php echo Html::a($model->title, ['view', 'category'=>$model->category->slug, 'slug'=>$model->slug]) ?>
                </h2>
                <p class="blog-grid-item__subtitle"><?php echo $model->subtitle; ?></p>
            </div>
        </div>

    </div>
</div>
