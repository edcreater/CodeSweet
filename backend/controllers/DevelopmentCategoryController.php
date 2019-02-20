<?php

namespace backend\controllers;

use backend\models\search\DevelopmentCategorySearch;
use common\models\DevelopmentCategory;
use common\models\Seofield;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * DevelopmentCategoryController implements the CRUD actions for DevelopmentCategory model.
 */
class DevelopmentCategoryController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all DevelopmentCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DevelopmentCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DevelopmentCategory model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DevelopmentCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DevelopmentCategory();

        $categories = DevelopmentCategory::find()->noParents()->all();
        $categories = ArrayHelper::map($categories, 'id', 'title');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $seofield = new Seofield();

            $seofield->seotitle = Yii::$app->request->post('seotitle');
            $seofield->seodescription = Yii::$app->request->post('seodescription');

            if ($seofield->save()) {
                $model->link('seofield', $seofield);
            }

            if ($model->save()) {
                return $this->redirect(['index']);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * Updates an existing DevelopmentCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $seofield = $model->seofield;

        $categories = DevelopmentCategory::find()->noParents()->andWhere(['not', ['id' => $id]])->all();
        $categories = ArrayHelper::map($categories, 'id', 'title');


        if ($model->load(Yii::$app->request->post()) && $seofield->load(Yii::$app->request->post())) {
            if ($model->save() && $seofield->save()) {
                return $this->redirect(['index']);
            } else {
                throw new ServerErrorHttpException(Yii::t('test', 'Updating your data has go wrong'));
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * Deletes an existing DevelopmentCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        $model = $this->findModel($id);

        $model->delete();

        $this->findModelSeofield($model->seofield_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DevelopmentCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DevelopmentCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DevelopmentCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the Seofield model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DevelopmentCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelSeofield($id)
    {
        if (($model = Seofield::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
