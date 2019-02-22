<?php
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

/* @var $searchModel frontend\models\search\DevelopmentSearch */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\LinkPager;

/**
 * Seo metatags
 */
$this->title = $seotitle;
$this->registerMetaTag( [
	'name'    => 'description',
	'content' => $seodescription
] );
?>
<section class="page-heading">
    <div class="page-heading__inner">
        <div class="container">
            <h1 class="page-heading__title"><?php echo $title; ?></h1>
            <p class="page-heading__subtitle"><?php echo $subtitle; ?></p>
        </div>
    </div>
</section>

<section class="page-container">
    <div class="page-layout">
        <div class="page-layout__content">
            <div class="developments-list">
                <div class="container">
				<?php
				/*
				echo \yii\widgets\ListView::widget([
					'dataProvider' => $dataProvider,
					'pager' => [
						'hideOnSinglePage' => true,
					],
					'itemView' => '_item'
				])
				*/
				?>
				<?php
				if ( $developments ) {
					foreach ( $developments as $development ) {
						echo $this->render( '_item', [
							'model' => $development,
						] );
					}
				}
				?>
                </div>
                <div class="developments-list__bg-bottom">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
                        <path class="developments-list__shape-fill" opacity="0.33" d="M473,67.3c-203.9,88.3-263.1-34-320.3,0C66,119.1,0,59.7,0,59.7V0h1000v59.7 c0,0-62.1,26.1-94.9,29.3c-32.8,3.3-62.8-12.3-75.8-22.1C806,49.6,745.3,8.7,694.9,4.7S492.4,59,473,67.3z"></path>
                        <path class="developments-list__shape-fill" opacity="0.66" d="M734,67.3c-45.5,0-77.2-23.2-129.1-39.1c-28.6-8.7-150.3-10.1-254,39.1 s-91.7-34.4-149.2,0C115.7,118.3,0,39.8,0,39.8V0h1000v36.5c0,0-28.2-18.5-92.1-18.5C810.2,18.1,775.7,67.3,734,67.3z"></path>
                        <path class="developments-list__shape-fill" d="M766.1,28.9c-200-57.5-266,65.5-395.1,19.5C242,1.8,242,5.4,184.8,20.6C128,35.8,132.3,44.9,89.9,52.5C28.6,63.7,0,0,0,0 h1000c0,0-9.9,40.9-83.6,48.1S829.6,47,766.1,28.9z"></path>
                    </svg>
                </div>
                <svg width="32" height="30" viewBox="0 0 32 30" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                    <clipPath id="developments-list__clipper" clipPathUnits="objectBoundingBox">
                        <path id="p1" d="M0.0313835 0.485391C-0.0668063 0.823701 0.0609271 1.04164 0.478016 0.99331C0.895106 0.94498 1.07324 0.690564 0.972441 0.392378C0.871645 0.0941924 0.637032 0.0312792 0.532759 0.00300387C0.428487 -0.0252714 0.129573 0.147082 0.0313835 0.485391Z" fill="#C4C4C4"/>
                        <animate id="developments-list__clipper-hover" xlink:href="#p1"
                                 attributeName="d"
                                 attributeType="XML"
                                 from="M0.0313835 0.485391C-0.0668063 0.823701 0.0609271 1.04164 0.478016 0.99331C0.895106 0.94498 1.07324 0.690564 0.972441 0.392378C0.871645 0.0941924 0.637032 0.0312792 0.532759 0.00300387C0.428487 -0.0252714 0.129573 0.147082 0.0313835 0.485391Z"
                                 to="M0.000123047 0.490374C0.000123046 1.00936 0.000122889 0.999989 0.504469 0.999989C0.987453 0.999989 1 0.999989 1 0.490374C1 3.2885e-07 1 3.01996e-07 0.50447 3.03113e-07C-0.0213865 3.04298e-07 0.000123048 -0.00252058 0.000123047 0.490374Z"
                                 dur="0.2s"
                                 begin="indefinite"
                                 fill="freeze" />
                        <animate  id="developments-list__clipper-unhover" xlink:href="#p1"
                                 attributeName="d"
                                 attributeType="XML"
                                 from="M0.000123047 0.490374C0.000123046 1.00936 0.000122889 0.999989 0.504469 0.999989C0.987453 0.999989 1 0.999989 1 0.490374C1 3.2885e-07 1 3.01996e-07 0.50447 3.03113e-07C-0.0213865 3.04298e-07 0.000123048 -0.00252058 0.000123047 0.490374Z"
                                 to="M0.0313835 0.485391C-0.0668063 0.823701 0.0609271 1.04164 0.478016 0.99331C0.895106 0.94498 1.07324 0.690564 0.972441 0.392378C0.871645 0.0941924 0.637032 0.0312792 0.532759 0.00300387C0.428487 -0.0252714 0.129573 0.147082 0.0313835 0.485391Z"
                                 dur="0.2s"
                                  begin="indefinite"
                                 fill="freeze" />
                    </clipPath>
                    </defs>
                </svg>
            </div>

            <div class="pagination__outer">
				<?php
				echo LinkPager::widget( [
					'pagination'     => $pages,
					'maxButtonCount' => 15,
					// Отключаю ссылку "Следующий"
					'nextPageLabel'  => false,
					// Отключаю ссылку "Предыдущий"
					'prevPageLabel'  => false,
				] );
				?>
            </div>

            <div class="developments-content">
                <div class="container">
                    <div class="developments-content__columns">
                        <div class="developments-content__column developments-content__column--left">
                            <h2 class="developments-content__title">Мы давно занимаемся веб разработкой</h2>
                            <p>И, естественно, у нас скопились кое-какие скрипты, плагины для вордпресса, шаблоны и много прочей вкуснятины. А написанный <strong>функционал должен использоваться</strong>. Для того чтобы все это не простаивало без дела - мы решили поделиться ими с общественностью. Все решения <strong>доступны для свободного использования</strong>.</p>
                            <br>
                            <a href="#" class="btn btn--primary"><i class="far fa-credit-card"></i>Заказать индивидуальное решение</a>
                        </div>
                        <div class="developments-content__column developments-content__column--right">
                            <img src="<?php echo \Yii::$app->request->BaseUrl; ?>/images/woman-design.png" class="img-fluid" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>
