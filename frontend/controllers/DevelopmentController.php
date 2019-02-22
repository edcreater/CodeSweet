<?php
/**
 * Created by Ed.Creater <ed.creater@gmail.com>.
 * Author Site: http://codesweet.ru
 * Date: 11.11.2018
 */

namespace frontend\controllers;

use common\models\Development;
use common\models\DevelopmentAttachment;
use common\models\DevelopmentCategory;
use frontend\models\search\DevelopmentSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;

/**
 * @author Yaroslav Popov <ed.creater@codesweet.ru>
 */
class DevelopmentController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        /*
        $searchModel = new DevelopmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['created_at' => SORT_DESC]
        ];
        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
        */
        $query = Development::find()->where([
            'status' => Development::STATUS_PUBLISHED
        ]);

        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 25,
            'defaultPageSize' => 25,
            'pageParam' => 'pageNum',
            'forcePageParam' => false,
        ]);

        $developments = $query->offset($pages->offset)->limit($pages->limit)->orderBy('created_at desc')->all();

        return $this->render('index', [
	        'seotitle'       => 'CodeSweet | Наши разработки',
	        'seodescription' => 'Наши разработки: плагины, модули, шаблоны и прочее',
	        'title'          => 'Наши разработки',
	        'subtitle'       => 'Плагины, модули, шаблоны и прочие плюшки',
            'developments' => $developments,
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
        $model = Development::find()->published()->andWhere(['slug' => $slug])->one();
        if (!$model) {
            throw new NotFoundHttpException;
        }

        $seofields = $model->seofield;

        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $seofields->seodescription
        ]);

        $viewFile = $model->view ?: 'view';
        return $this->render($viewFile, ['model' => $model, 'seofields'=>$seofields]);
    }

    /**
     * @param $id
     * @return $this
     * @throws NotFoundHttpException
     * @throws \yii\web\HttpException
     */
    public function actionAttachmentDownload($id)
    {
        $model = DevelopmentAttachment::findOne($id);
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
        $model = DevelopmentCategory::find()->active()->andWhere(['slug' => $category])->one();
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
