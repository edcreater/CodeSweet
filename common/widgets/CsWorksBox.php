<?php
/**
 * Created by EdCreater.
 * Email: ed.creater@gmail.com
 * Site: codesweet.ru
 * Date: 25.12.2017
 */

namespace common\widgets;

use common\models\Work;
use yii\base\Widget;
use Yii;
use yii\helpers\Html;

/**
 * Class CsWorkBox
 * Return a base works stored in db
 * @package common\widgets
 */
class CsWorksBox extends Widget
{
    /**
     * @var string text block key
     */
    public $count_items;

    /**
     * @return string
     */
    public function run()
    {


        $items = Work::find()
            ->where(['status' => Work::STATUS_PUBLISHED])
            ->orderBy('published_at DESC')
            ->limit($this->count_items)
            ->all();

        if ($items) {

            ?>
            <div class="container">
            <div class="works-box">
                <?php
                foreach ($items as $item) {


                    ?>

                    <div class="works-box__item work-box <?php echo $item->size; ?>">
                        <div class="work-box__inner">
                            <div class="work-box__thumb">
                                <a href="#" class="work-box__link">
                                    <?php echo Html::img('@storageUrl/thumbs/' . $item->thumbnail['path']); ?>
                                </a>
                            </div>
                            <div class="work-box__title work-box__title--js">
                                <?php echo $item->title; ?>
                            </div>
                        </div>

                    </div>


                    <?php
                };
                ?>
            </div><!-- End works-box -->
            </div>
            <?php
        }

        return false;
    }
}
