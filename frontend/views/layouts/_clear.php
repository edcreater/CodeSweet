<?php
use yii\helpers\Html;
/* @var $this \yii\web\View */
/* @var $content string */

\frontend\assets\FrontendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language ?>">
<head>
    <meta charset="<?php echo Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="google-site-verification" content="y6i4FvC23p1Fj7D8FXBAjj8NLvFwNFQtWl6cFR3zIM8" />
    <meta name='yandex-verification' content='629a37a0e9b3d162' />
    <meta name="webmoney" content="EB02B9BF-70BD-43FD-A580-D03251AED6AF"/>

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo \Yii::$app->request->BaseUrl; ?>/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo \Yii::$app->request->BaseUrl; ?>/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo \Yii::$app->request->BaseUrl; ?>/favicons/favicon-16x16.png">
    <link rel="manifest" href="<?php echo \Yii::$app->request->BaseUrl; ?>/favicons/site.webmanifest">
    <link rel="mask-icon" href="<?php echo \Yii::$app->request->BaseUrl; ?>/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <title><?php echo Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php echo Html::csrfMetaTags() ?>

	<!-- Yandex.Metrika counter -->
	<script type="text/javascript" >
		(function (d, w, c) {
			(w[c] = w[c] || []).push(function() {
				try {
					w.yaCounter30164969 = new Ya.Metrika({
						id:30164969,
						clickmap:true,
						trackLinks:true,
						accurateTrackBounce:true
					});
				} catch(e) { }
			});

			var n = d.getElementsByTagName("script")[0],
				s = d.createElement("script"),
				f = function () { n.parentNode.insertBefore(s, n); };
			s.type = "text/javascript";
			s.async = true;
			s.src = "https://mc.yandex.ru/metrika/watch.js";

			if (w.opera == "[object Opera]") {
				d.addEventListener("DOMContentLoaded", f, false);
			} else { f(); }
		})(document, window, "yandex_metrika_callbacks");
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/30164969" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- /Yandex.Metrika counter -->
<script data-ad-client="ca-pub-9493950254006774" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

</head>
<body>
<?php $this->beginBody() ?>
    <?php echo $content ?>
<?php $this->endBody() ?>
<script src="/app.js"></script>

<?php include(Yii::getAlias('@frontend/web/images/default.svg')); ?>
</body>
</html>
<?php $this->endPage() ?>
