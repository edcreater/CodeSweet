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
			    <?php
                ob_start();
                include('thumb-' . $model->id . '.php');
                $thumb = ob_get_clean();
                ?>
			    <?php echo Html::a($thumb, ['view', 'category'=>$model->category->slug, 'slug'=>$model->slug]) ?>
		    <?php endif; ?>
        </div>

        <div class="developments-list-item__content">

            <div class="developments-list-item__meta article-meta">
                <div class="article-meta__item">
                    <span class="article-meta__ico">
                        <svg class="icon" width="36px" height="36px"><use xlink:href="#icon-calendar"></use></svg>
                    </span>
                    <span class="article-meta__label">
                        <?php echo Yii::$app->formatter->asDate($model->created_at) ?>
                    </span>
                </div>
                <div class="article-meta__item">
                   <span class="article-meta__ico">
                        <svg class="icon" width="36px" height="36px"><use xlink:href="#icon-newspaper"></use></svg>
                    </span>
                    <span class="article-meta__label">
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
