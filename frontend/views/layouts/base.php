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
                                        <img src="<?php echo \Yii::$app->request->BaseUrl; ?>/images/logo.png" class="img-fluid" />
                                    </div>
                                    <div class="logo__text">
                                        <p class="logo__title"><span class="logo__title--darked">CODE</span>SWEET</p>
                                        <p class="logo__subtitle">разработка и проектирование</p>
                                    </div>
                                </a>
                            </div>
                            <nav class="header__menu navbar" itemscope="" itemtype="http://www.schema.org/SiteNavigationElement">
                                <button class="navbar__toggler js-menu-toggle">
                                    <svg class="icon" width="36px" height="36px">
                                        <use xlink:href="#icon-menu"></use>
                                    </svg>
                                </button>
                                <div class="navbar__inner js-menu">
									<?php echo \common\widgets\CsMainMenu::widget( [] ); ?>
                                </div>
                            </nav>
                            <div class="header__contacts">
                                <div class="header-phone">
                                    <svg class="header-phone__icon icon" width="20px" height="20px">
                                        <use xlink:href="#icon-phone"></use>
                                    </svg>
                                    <a class="header-phone__tel" href="tel://+79924251686">+7 (992) 425 16 86</a>
                                </div>
                                <p class="header-time">c 9-00 до 18-00</p>
                                <!--<ul class="socials">
                                    <li class="socials__item">
                                        <a href="http://vk.com/club64552026" class="socials__ico socials__ico--vk" target="_blank">
                                            <svg class="icon" width="16px" height="16px">
                                                <use xlink:href="#icon-vk"></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="socials__item">
                                        <a href="https://www.facebook.com/Codesweetru-1456425611243593/" class="socials__ico socials__ico--fb" target="_blank">
                                            <svg class="icon" width="16px" height="16px">
                                                <use xlink:href="#icon-insta"></use>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>-->
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