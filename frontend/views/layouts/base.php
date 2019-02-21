<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

$this->beginContent( '@frontend/views/layouts/_clear.php' )
?>
    <div class="wrapper">

        <div class="wrapper__content">


            <header class="header" itemscope="" itemtype="http://schema.org/WPHeader">
                <div class="curved-hz-1">
                    <div class="container">
                        <div class="header__inner">
                            <div class="header__logo logo">
                                <a href="/" itemprop="name" class="logo__link">
                                    <div class="logo__thumb">
                                        <img src="<?php echo \Yii::$app->request->BaseUrl; ?>/images/logo.png">
                                    </div>
                                    <div class="logo__text">
                                        <p class="logo__title"><span class="logo__title--darked">CODE</span>SWEET</p>
                                        <p class="logo__subtitle">разработка и проектирование</p>
                                    </div>
                                </a>
                            </div>
                            <nav class="header__menu topmenu" itemscope="" itemtype="http://www.schema.org/SiteNavigationElement">
                                <div class="menu-glavnoe-menyu-container">
									<?php echo \common\widgets\CsMainMenu::widget( [] ); ?>
                                </div>
                            </nav>
                            <div class="header__socials socials">
                                <a href="http://vk.com/club64552026" class="ico-vk" target="_blank"></a>
                                <a href="https://www.facebook.com/Codesweetru-1456425611243593/" class="ico-fb" target="_blank"></a>
                                <a href="#" class="mobile-button"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

			<?php echo $content ?>

        </div>

        <footer class="wrapper__footer footer">
            <div class="container">
                <p class="pull-left">© CodeSweet.ru, 2015</p>
                <p class="pull-right"><i>«Простота — дух эффективности.»</i></p>
            </div>
        </footer>

    </div>

<?php $this->endContent() ?>