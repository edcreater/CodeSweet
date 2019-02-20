<?php
/**
 * Created by EdCreater.
 * Email: ed.creater@gmail.com
 * Site: codesweet.ru
 * Date: 25.12.2017
 */

namespace common\widgets;

use common\models\ArticleCategory;
use yii\base\Widget;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Class SideArticleCategories
 * Return a base categories stored in db
 * @package common\widgets
 */
class CsMainMenu extends Widget
{

    /**
     * @return string
     */
    public function run()
    {


        $items =  ArticleCategory::find()
            ->where(['status' => ArticleCategory::STATUS_ACTIVE])
            ->all();
        if ($items) {

            ?>
            <ul id="menu-glavnoe-menyu" class="menu clearfix">
                <li class="menu-item">
                    <a title="Портфолио" itemprop="url" href="https://codesweet.ru/portfolio/">
                        <p class="strong">Портфолио</p><p class="sub">Наши работы</p>
                    </a>
                </li>
                <li class="menu-item menu-item-has-children">
                    <a title="Блог" itemprop="url" href="<?php echo Url::toRoute(['article/index']); ?>">
                        <p class="strong">Блог</p><p class="sub">Мысли вслух</p>
                    </a>
                    <ul class="sub-menu">
                        <?php foreach ($items as $item) { ?>
                        <li class="menu-item">
                            <?php echo Html::a(
                                $item->title,
                                ['article/category', 'category' => $item->slug]
                            )?>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
                <li id="menu-item-108" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">
                    <a title="Разработки" itemprop="url" href="https://codesweet.ru/developments/">
                        <p class="strong">Разработки</p><p class="sub">Кодопомойка</p>
                    </a>
                    <ul class="sub-menu">
                        <li id="menu-item-462" class="menu-item menu-item-type-post_type menu-item-object-cs_developments">
                            <a title="Шаблон Blogissimo" href="https://codesweet.ru/developments/wordpress-templates/blogissimo/">
                                <p class="strong">Шаблон Blogissimo</p><p class="sub">Бесплатный и адаптивный</p>
                            </a>
                        </li>
                        <li id="menu-item-456" class="menu-item menu-item-type-post_type menu-item-object-cs_developments">
                            <a title="CS Likes Counter" href="https://codesweet.ru/developments/wordpress-plugins/cs-likes-counter/"><p class="strong">CS Likes Counter</p>
                                <p class="sub"></p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li id="menu-item-7" class="menu-item menu-item-type-post_type menu-item-object-page">
                    <a title="Контакты" itemprop="url" href="https://codesweet.ru/contact/">
                        <p class="strong">Контакты</p><p class="sub">Связаться с нами</p>
                    </a>
                </li>
            </ul>

            <?php
        }

        return false;
    }
}
