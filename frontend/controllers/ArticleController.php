<?php

namespace frontend\controllers;

use common\models\Article;
use common\models\ArticleAttachment;
use common\models\ArticleCategory;
use frontend\models\search\ArticleSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class ArticleController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
    	/*
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['created_at' => SORT_DESC]
        ];
        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    	*/
	    $query = Article::find()->where([
		    'status' => Article::STATUS_PUBLISHED
	    ]);

	    $countQuery = clone $query;
	    $pages = new Pagination([
		    'totalCount' => $countQuery->count(),
		    'pageSize' => 25,
		    'defaultPageSize' => 25,
		    'pageParam' => 'pageNum',
		    'forcePageParam' => false,
	    ]);

	    $articles = $query->offset($pages->offset)->limit($pages->limit)->orderBy('created_at desc')->all();

	    return $this->render('index', [
		    'seotitle' => 'CodeSweet | Статьи о веб-разработке',
		    'seodescription' => 'Полезные статьи о веб разработке. создании сайтов и не только',
		    'title' => 'Статьи',
		    'subtitle' => 'Здесь мы будем делиться с вами новостями и полезными штуками',
		    'articles' => $articles,
		    'pages' => $pages
	    ]);
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($category, $slug)
    {
        $model = Article::find()->published()->andWhere(['slug' => $slug])->one();
        if (!$model) {
            throw new NotFoundHttpException;
        }

        $seofields = $model->seofield;

        $viewFile = $model->view ?: 'view';
        return $this->render($viewFile, [
        	'model' => $model,
	        'seofields'=>$seofields
        ]);
    }

    /**
     * @param $id
     * @return $this
     * @throws NotFoundHttpException
     * @throws \yii\web\HttpException
     */
    public function actionAttachmentDownload($id)
    {
        $model = ArticleAttachment::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException;
        }

        return Yii::$app->response->sendStreamAsFile(
            Yii::$app->fileStorage->getFilesystem()->readStream($model->path),
            $model->name
        );
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionCategory($category)
    {
		\Yii::$app->cache->flush();
        $model = ArticleCategory::find()->active()->andWhere(['slug' => $category])->one();
        if (!$model) {
            throw new NotFoundHttpException;
        }

        $seofields = $model->seofield;

        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $seofields->seodescription
        ]);

        return $this->render('viewCategory', ['model' => $model, 'seofields'=>$seofields]);
    }
}
