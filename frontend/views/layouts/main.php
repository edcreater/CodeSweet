<?php
/* @var $this \yii\web\View */
use yii\helpers\ArrayHelper;
use common\widgets\DbText;

/* @var $content string */

$this->beginContent('@frontend/views/layouts/base.php')
?>

	<?php if(Yii::$app->session->hasFlash('alert')):?>
    <?php
        $options = ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options');
    ?>
        <div class="alert <?php echo $options['class']; ?>">
            <div class="container">
                <?php echo ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'); ?>
            </div>
        </div>
	<?php endif; ?>

	<!-- Example of your ads placing -->
	<?php echo DbText::widget([
		'key' => 'ads-example'
	]) ?>

	<?php echo $content ?>

<?php $this->endContent() ?>