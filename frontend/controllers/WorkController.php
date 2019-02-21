<?php
/**
 * Created by Ed.Creater <ed.creater@gmail.com>.
 * Author Site: http://codesweet.ru
 * Date: 11.11.2018
 */

namespace frontend\controllers;

use common\models\Work;
use common\models\WorkAttachment;
use common\models\WorkCategory;
use frontend\models\search\WorkSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;

/**
 * @author Yaroslav Popov <ed.creater@codesweet.ru>
 */
class WorkController extends Controller
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
        $query = Work::find()->where([
            'status' => Work::STATUS_PUBLISHED
        ]);

        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 25,
            'defaultPageSize' => 25,
            'pageParam' => 'pageNum',
            'forcePageParam' => false,
        ]);

        $works = $query->offset($pages->offset)->limit($pages->limit)->orderBy('created_at desc')->all();

        return $this->render('index', [
        	'seotitle' => 'CodeSweet | Наше портфолио - мы создаем сайты быстро и качественно',
            'seodescription' => 'Портфолио от команды разработчиков CodeSweet. Выполненные проекты по созданию сайтов',
            'title' => 'Посмотрите наше портфолио',
            'subtitle' => 'Мы постарались выполнить эти проекты качественно',
            'works' => $works,
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
        $model = Work::find()->published()->andWhere(['slug' => $slug])->one();
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
        $model = WorkAttachment::findOne($id);
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
        $model = WorkCategory::find()->active()->andWhere(['slug' => $category])->one();
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
