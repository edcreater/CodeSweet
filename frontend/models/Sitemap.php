<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Article;
use common\models\ArticleCategory;
use yii\db\Query;

class Sitemap extends Model
{

    public function getUrl()
    {

        $urls = [
            [
                'loc' => '/',
                'lastmod'    => date(DATE_W3C),
                'changefreq' => 'daily',
                'priority'   => 1.0
            ],
            [
                'loc' => '/portfolio/',
                'lastmod'    => date(DATE_W3C),
                'changefreq' => 'daily',
                'priority'   => 1.0
            ],
            [
                'loc' => '/blog/',
                'lastmod'    => date(DATE_W3C),
                'changefreq' => 'daily',
                'priority'   => 1.0
            ],
            [
                'loc' => '/developments/',
                'lastmod'    => date(DATE_W3C),
                'changefreq' => 'daily',
                'priority'   => 1.0
            ],
        ];

        // Articles
        $query = new Query;
        $query->select([
            'article.slug AS slug', 'article.updated_at AS updated_at', 'article_category.slug as category_slug'
        ])
              ->from('article')
              ->leftJoin('article_category', 'article_category.id = article.category_id');

        $command = $query->createCommand();
        $data    = $command->queryAll();

        foreach ($data as $row) {
            $urls[] = [
                'loc'        => Yii::$app->urlManager->createUrl([
                    'article/view', 'category' => $row['category_slug'], 'slug' => $row['slug']
                ]),
                'lastmod'    => date(DATE_W3C, $row['updated_at']),
                'changefreq' => 'daily',
                'priority'   => 1.0
            ];
        }

        //Рубрики
        $url_cats = ArticleCategory::find()
                                   ->select(['slug', 'updated_at'])
                                   ->all();
        foreach ($url_cats as $row) {
            $urls[] = [
                'loc'        => Yii::$app->urlManager->createUrl(['article/category', 'category' => $row->slug]),
                'lastmod'    => date(DATE_W3C, $row->updated_at),
                'changefreq' => 'daily',
                'priority'   => 1.0
            ];
        }

        // Developments
        $query = new Query;
        $query->select([
            'development.slug AS slug', 'development.updated_at AS updated_at', 'development_category.slug as category_slug'
        ])
            ->from('development')
            ->leftJoin('development_category', 'development_category.id = development.category_id');

        $command = $query->createCommand();
        $data    = $command->queryAll();

        foreach ($data as $row) {
            $urls[] = [
                'loc'        => Yii::$app->urlManager->createUrl([
                    'development/view', 'category' => $row['category_slug'], 'slug' => $row['slug']
                ]),
                'lastmod'    => date(DATE_W3C, $row['updated_at']),
                'changefreq' => 'daily',
                'priority'   => 1.0
            ];
        }

        // Portfolio
        $query = new Query;
        $query->select([
            'work.slug AS slug', 'work.updated_at AS updated_at', 'work_category.slug as category_slug'
        ])
            ->from('work')
            ->leftJoin('work_category', 'work_category.id = work.category_id');

        $command = $query->createCommand();
        $data    = $command->queryAll();

        foreach ($data as $row) {
            $urls[] = [
                'loc'        => Yii::$app->urlManager->createUrl([
                    'work/view', 'category' => $row['category_slug'], 'slug' => $row['slug']
                ]),
                'lastmod'    => date(DATE_W3C, $row['updated_at']),
                'changefreq' => 'daily',
                'priority'   => 1.0
            ];
        }


        return $urls;
    }
}