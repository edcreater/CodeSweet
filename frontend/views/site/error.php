<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;

$this->params['breadcrumbs'][] = $this->title;

if ($exception->statusCode == '404') {
	$this->title = \common\widgets\DbText::widget([
		'key' => '404-title'
	]);

	$message = \common\widgets\DbText::widget([
		'key' => '404-content'
	]);
};
?>

<section class="page__heading page-heading">
    <div class="page-heading__inner">

        <div class="container">
            <h1 class="page-heading__title"><?php echo Html::encode($this->title) ?></h1>
            <p class="page-heading__subtitle">Упс, возникла проблема</p>
            <div class="page-heading__breadcrumbs">
				<?php echo Breadcrumbs::widget([
					'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
				]) ?>
            </div>
        </div>

    </div>
</section>

<div class="page__content">
    <div class="container">
        <div class="layout">
            <div class="layout__content content">

	            <?php echo nl2br(Html::decode($message)) ?>

            </div>
        </div>
    </div>
</div>
