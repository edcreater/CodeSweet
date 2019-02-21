<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
//$this->title = Yii::$app->name;
$this->title = 'CodeSweet | Разработка, оптимизация, поддержка сайтов';
\Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => 'Команда разработчиков CodeSweet - разработка сайтов с уникальным дизайном и продуманным функционалом. А также дальнейшая техподдержка и сопровождение.'
]);
\Yii::$app->view->registerMetaTag([
    'property' => 'og:type',
    'content' => 'article'
]);
\Yii::$app->view->registerMetaTag([
    'property' => 'og:title',
    'content' => 'CodeSweet - Разработка, оптимизация, поддержка сайтов'
]);
\Yii::$app->view->registerMetaTag([
    'property' => 'og:description',
    'content' => 'Команда разработчиков codesweet.ru - разработка сайтов с уникальным дизайном и продуманным функционалом. А также дальнейшая техподдержка и сопровождение.'
]);
\Yii::$app->view->registerMetaTag([
    'property' => 'og:url',
    'content' => 'https://codesweet.ru/'
]);
\Yii::$app->view->registerMetaTag([
    'property' => 'og:image',
    'content' => 'https://codesweet.ru/images/logo.png'
]);
?>

<div class="h-illustration">
    <div class="container">
        <div class="h-illustration__inner">

            <div class="h-illustration__description">
                <h3><strong>Разработка сайта</strong> это<br>
                    не сложно!</h3>
                <p>Мы не просто занимаемся штамповкой веб-приложений, мы стремимся сделать интернет пространство лучше, безопасней и удобней.</p>
            </div>

            <div class="h-illustration__iconbox iconbox">
                <div class="iconbox__item">
                    <div class="iconbox__item-icon">
                        <svg class="icon" width="32px" height="32px">
                            <use xlink:href="#icon-timeline"></use>
                        </svg>
                    </div>
                    <div class="title">Проработка структуры</div>
                </div>
                <div class="iconbox__item">
                    <div class="iconbox__item-icon">
                        <svg class="icon" width="32px" height="32px">
                            <use xlink:href="#icon-image"></use>
                        </svg>
                    </div>
                    <div class="title">Создание дизайна</div>
                </div>
                <div class="iconbox__item">
                    <div class="iconbox__item-icon">
                        <svg class="icon" width="32px" height="32px">
                            <use xlink:href="#icon-tools"></use>
                        </svg>
                    </div>
                    <div class="title">Разработка функционала</div>
                </div>
                <div class="iconbox__item">
                    <div class="iconbox__item-icon">
                        <svg class="icon" width="32px" height="32px">
                            <use xlink:href="#icon-content"></use>
                        </svg>
                    </div>
                    <div class="title">Наполнение контентом</div>
                </div>
                <div class="iconbox__item">
                    <div class="iconbox__item-icon">
                        <svg class="icon" width="32px" height="32px">
                            <use xlink:href="#icon-upload"></use>
                        </svg>
                    </div>
                    <div class="title">Размещение в интернете</div>
                </div>
                <div class="iconbox__item">
                    <div class="iconbox__item-icon">
                        <svg class="icon" width="32px" height="32px">
                            <use xlink:href="#icon-competition"></use>
                        </svg>
                    </div>
                    <div class="title">Профит!</div>
                </div>
            </div>

        </div>
    </div>
</div>

<section class="info-numbers">
    <div class="container">
        <div class="info-numbers__inner">
            <div class="info-numbers__heading">
                <div class="info-numbers__heading-box">
                    <div class="info-numbers__heading-box-inner">
                        <p class="info-numbers__title">Наши результаты</p>
                        <p class="info-numbers__subtitle">за годы плодотворной работы</p>
                    </div>
                </div>
            </div>
            <div class="info-numbers__content">
                <div class="info-numbers__items">
                    <div class="info-numbers__item info-number">
                        <div class="info-number__ico">
                            <img src="<?php echo \Yii::$app->request->BaseUrl; ?>/images/ico-compas.png">
                        </div>
                        <p class="info-number__title">123</p>
                        <p class="info-number__subtitle">выполненных проекта</p>
                    </div>
                    <div class="info-numbers__item info-number">
                        <div class="info-number__ico">
                            <img src="<?php echo \Yii::$app->request->BaseUrl; ?>/images/ico-user.png">
                        </div>
                        <p class="info-number__title">123</p>
                        <p class="info-number__subtitle">довольных клиента</p>
                    </div>
                    <div class="info-numbers__item info-number">
                        <div class="info-number__ico">
                            <img src="<?php echo \Yii::$app->request->BaseUrl; ?>/images/ico-money.png">
                        </div>

                        <p class="info-number__title">100500</p>
                        <p class="info-number__subtitle">прибыли клиентам</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="h-services">
    <div class="container">

        <div class="section-heading section-heading--centered">
            <h3 class="section-heading__title section-heading__title--centered">Что мы можем <span class="theme-color"><strong>вам предложить </strong></span> </h3>
            <p class="section-heading__subtitle">Услуги, которые мы предоставляем</p>
        </div>

        <div class="h-services__row">

            <div class="services-box">

                    <div class="services-box__item service-box">
                        <div class="service-box__inner">
                            <div class="service-box__thumb">
                                <div class="service-box__overlay"></div>
                                    <img src="<?php echo Yii::getAlias('@storageUrl'); ?>/services/internet-magazin.png" class="img-fluid" />
                                <div class="service-box__title service-box__title--js" title="Разработка интернет магазина">
                                    Разработка интернет магазина
                                </div>
                            </div>
                        </div>
                        <a href="#" class="btn btn--primary service-box__button">
                            <span class="ico"></span>
                            <span class="label">Узнать подробнее</span>
                        </a>
                    </div>

                    <div class="services-box__item service-box">
                        <div class="service-box__inner">
                            <div class="service-box__thumb">
                                <div class="service-box__overlay"></div>
                                    <img src="<?php echo Yii::getAlias('@storageUrl'); ?>/services/odnostranichnik.png" class="img-fluid" />
                                <div class="service-box__title service-box__title--js" title="Разработка одностраничника">
                                    Разработка одностраничника
                                </div>
                            </div>
                        </div>
                        <a href="#" class="btn btn--primary service-box__button">
                            <span class="ico"></span>
                            <span class="label">Узнать подробнее</span>
                        </a>
                    </div>

                    <div class="services-box__item service-box">
                        <div class="service-box__inner">
                            <div class="service-box__thumb">
                                <div class="service-box__overlay"></div>
                                    <img src="<?php echo Yii::getAlias('@storageUrl'); ?>/services/internet-magazin.png" class="img-fluid" />
                                <div class="service-box__title service-box__title--js" title="Программирование сайта">
                                    Программирование сайта
                                </div>
                            </div>
                        </div>
                        <a href="#" class="btn btn--primary service-box__button">
                            <span class="ico"></span>
                            <span class="label">Узнать подробнее</span>
                        </a>
                    </div>

                    <div class="services-box__item service-box">
                        <div class="service-box__inner">
                            <div class="service-box__thumb">
                                <div class="service-box__overlay"></div>
                                    <img src="<?php echo Yii::getAlias('@storageUrl'); ?>/services/internet-magazin.png" class="img-fluid" />
                                <div class="service-box__title service-box__title--js" title="Разработка дизайна">
                                    Разработка дизайна
                                </div>
                            </div>
                        </div>
                        <a href="#" class="btn btn--primary service-box__button">
                            <span class="ico"></span>
                            <span class="label">Узнать подробнее</span>
                        </a>
                    </div>


            </div><!-- End services-box -->

        </div>

        <div class="h-services__buttons">
            <a href="#" class="h-services__more-link">Ознакомиться со всеми услугами →</a>
        </div>
    </div>
</section>

<section class="about-section">
    <div class="container">
        <div class="about-section__content">

            <div class="about-section__row about-section__row--1">
                <div class="about-section__column about-section__column--1-1">
                    <img src="<?php echo \Yii::$app->request->BaseUrl; ?>/images/about-1.png" />
                </div>
                <div class="about-section__column about-section__column--1-2">
                    <p class="about-section__title">Немного о нас</p>
                    <p>Мы — это команда разработчиков, занимающихся созданием сайтов. Над вашим будущим сайтом будут работать: дизайнер — нарисует красивый макет, бэкенд-фронтенд программист — воплотит макет в функциональный сайт, контент-менеджер, оживит и наполнит сайт необходимыми материалами. Все это за сравнительно небольшую стоимость — мы ориентированы на дальнейшее сотрудничество, поддержку и развитие вашего проекта.</p>
                </div>
            </div>

            <div class="about-section__row about-section__row">
                <div class="about-section__column about-section__column--2-1">
                    <p class="about-section__title">Как оценивается проект</p>
                    <p>Кстати, о стоимости разработки сайта. Вы наверняка видели множество объявлений «создадим сайт за столько-то и столько-то денег», «разработка сайтов от стольки-то и стольки-то». Мы считаем что невозможно заранее назначить цену, не зная тонкостей и нюансов будущего проекта. Поэтому для оценки вашего проекта — свяжитесь с нами используя форму, или&nbsp;<a href="/kontakty/">контактную страницу</a>.</p>
                </div>
                <div class="about-section__column about-section__column--2-2">
                    <img src="<?php echo \Yii::$app->request->BaseUrl; ?>/images/about-2.png" />
                </div>
            </div>
        </div>
    </div>
</section>

<section class="inline-subscribe">
    <div class="container container--small">
        <div class="inline-subscribe__wrapper">
            <div class="inline-subscribe__heading">
                <h2 class="inline-subscribe__title">Подпишитесь на рассылку</h2>
                <p class="inline-subscribe__subtitle">Чтобы всегда быть в курсе новостей и акций</p>
            </div>
            <div class="inline-subscribe__inner">
                <form class="inline-subscribe__form">

                    <input type="text" name="cs-email" class="form-input inline-subscribe__input" />
                    <input type="submit" value="Подписаться" class="btn btn-primary inline-subscribe__button">

                </form>
                <span>или</span>
                <a href="#" class="inline-subscribe__link">Зарегистрироваться</a>
            </div>
        </div>
    </div>
</section>

<section class="h-portfolio">
    <div class="h-portfolio__inner">

        <div class="h-portfolio__heading section-heading section-heading--centered">
            <h3 class="h-portfolio__title section-heading__title section-heading__title--centered"><span class="theme-color"><strong>Ознакомьтесь</strong></span> с нашими работами</h3>
            <p class="h-portfolio__subtitle section-heading__subtitle">Мы отобрали лучшие работы и выложили в протфолио,<br>чтобы вы могли убедиться в нашем профессионализме</p>
        </div>

        <div class="h-portfolio__row">
			<?php echo \common\widgets\CsWorksBox::widget(['count_items' => 8]); ?>
        </div>

        <div class="h-portfolio__links">
            <div class="h-portfolio__links-inner">
            <span class="h-portfolio__arrow">
                <img src="<?php echo \Yii::$app->request->BaseUrl; ?>/images/arrow-pencil-primary.png" />
            </span>
            <a class="btn btn--primary h-portfolio__more-btn" href="">Здесь еще больше наших работ</a>
            </div>
        </div>
    </div>
</section>

<section class="h-team-posts">
    <div class="container">
        <div class="h-team-posts__inner">
            <div class="h-team-posts__column-1">

                    <div class="team-box">

                        <div class="team-box__heading">
                            <p class="team-box__title">Наша команда</p>
                        </div>

                        <div class="team-box__items">
                            <div class="team-box__item team-box-item">
                                <div class="team-box-item__thumb">
                                    <img width="100" height="70" src="<?php echo \Yii::$app->request->BaseUrl; ?>/images/yaroslavp-100x70.jpg" class="img-responsive wp-post-image" alt="">                                </div>
                                <div class="team-box-item__content">
                                    <div class="team-box-item__name">Ярослав Попов</div>
                                    <div class="team-box-item__position">Бэкенд разработчик / Менеджер проектов</div>
                                </div>
                            </div>
                            <div class="team-box__item team-box-item">
                                <div class="team-box-item__thumb">
                                    <img width="100" height="70" src="<?php echo \Yii::$app->request->BaseUrl; ?>/images/anton-100x70.jpg" class="img-responsive wp-post-image" alt="">                                </div>
                                <div class="team-box-item__content">
                                    <div class="team-box-item__name">Антон Васильев</div>
                                    <div class="team-box-item__position">Фронтенд разработчик</div>
                                </div>
                            </div>
                            <div class="team-box__item team-box-item">
                                <div class="team-box-item__thumb">
                                    <img width="100" height="70" src="<?php echo \Yii::$app->request->BaseUrl; ?>/images/viktor-100x70.jpg" class="img-responsive wp-post-image" alt="">                                </div>
                                <div class="team-box-item__content">
                                    <div class="team-box-item__name">Виктор Иваненко</div>
                                    <div class="team-box-item__position">Специалист по СЕО / Контент менеджер</div>
                                </div>
                            </div>
                        </div>

                    </div>
            </div>
            <div class="h-team-posts__column-2">
                <div class="h-posts__outer">

                    <div class="h-posts">
	                    <?php echo \common\widgets\CsArticlesBox::widget(['count_items' => 4]); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
