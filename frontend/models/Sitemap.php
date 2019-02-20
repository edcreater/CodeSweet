<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Article;
use common\models\ArticleCategory;
use yii\db\Query;

class Sitemap extends Model {

	public function getUrl() {

		$urls = array();

		// Games
		$query = new Query;
		$query->select( [ 'article.slug AS slug', 'article_category.slug as category_slug' ] )
		      ->from( 'article' )
		      ->leftJoin( 'article_category', 'article_category.id = article.category_id' );

		$command = $query->createCommand();
		$data    = $command->queryAll();

		foreach ( $data as $row ) {
			$urls[] = array( Yii::$app->urlManager->createUrl( [ 'article/view', 'category' => $row['category_slug'], 'slug' => $row['slug'] ] ), 'daily' );
		}

		//Рубрики
		$url_cats = ArticleCategory::find()
		                           ->select( 'slug' )
		                           ->all();
		foreach ( $url_cats as $url_cat ) {
			$urls[] = array( Yii::$app->urlManager->createUrl( [ 'article/category', 'category' => $url_cat->slug ] ), 'daily' );
		}

		return $urls;
	}

	//Формирует XML файл, возвращает в виде переменной
	public function getXml( $urls ) {
		$host = Yii::$app->request->hostInfo; // домен сайта
		ob_start();

		echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

            <url>
                <loc><?= $host ?></loc>
                <changefreq>daily</changefreq>
                <priority>1</priority>
            </url>

			<?php foreach ( $urls as $url ): ?>
                <url>
                    <loc><?= $host . $url[0] ?></loc>
                    <changefreq><?= $url[1] ?></changefreq>
                </url>
			<?php endforeach; ?>
        </urlset>

		<?php return ob_get_clean();
	}

	//Возвращает XML файл
	public function showXml( $xml_sitemap ) {
		// устанавливаем формат отдачи контента
		Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
		//повторно т.к. может не сработать
		header( "Content-type: text/xml" );
		echo $xml_sitemap;
		Yii::$app->end();
	}
}