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
$this->registerMetaTag([
    'name'    => 'description',
    'content' => $seodescription
]);

$this->params['breadcrumbs'][] = $title;
?>
<section class="page__heading page-heading">
    <div class="container">
        <div class="page-heading__inner">
            <div>
                <h1 class="page-heading__title"><?php echo $title; ?></h1>
                <p class="page-heading__subtitle"><?php echo $subtitle; ?></p>
            </div>
        </div>
    </div>
</section>

<div class="page__content">
    <div class="container">
        <div class="layout">
            <div class="layout__content">
                <div class="works-box">
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
                    if ($works) {
                        foreach ($works as $work) {
                            echo $this->render('_item', [
                                'model' => $work,
                            ]);
                        }
                    }
                    ?>
                </div>

                <div class="pagination__outer">
                    <?php
                    echo LinkPager::widget([
                        'pagination'     => $pages,
                        'maxButtonCount' => 15,
                        // Отключаю ссылку "Следующий"
                        'nextPageLabel'  => false,
                        // Отключаю ссылку "Предыдущий"
                        'prevPageLabel'  => false,
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>


</div>
