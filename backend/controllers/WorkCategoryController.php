<?php
/**
 * Created by Ed.Creater <ed.creater@gmail.com>.
 * Author Site: https://codesweet.ru
 * Date: 27.02.2018
 */

namespace backend\controllers;

use backend\models\search\WorkCategorySearch;
use common\models\WorkCategory;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * WorkCategoryController implements the CRUD actions for WorkCategory model.
 */
class WorkCategoryController extends Controller
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
	 * Lists all WorkCategory models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new WorkCategorySearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single WorkCategory model.
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
	 * Creates a new WorkCategory model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new WorkCategory();

		$categories = WorkCategory::find()->all();
		$categories = ArrayHelper::map($categories, 'id', 'title');

		if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['index']);

		} else {
			return $this->render('create', [
				'model' => $model,
				'categories' => $categories,
			]);
		}
	}

	/**
	 * Updates an existing WorkCategory model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		$categories = WorkCategory::find()->andWhere(['not', ['id' => $id]])->all();
		$categories = ArrayHelper::map($categories, 'id', 'title');


		if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['index']);

		} else {
			return $this->render('update', [
				'model' => $model,
				'categories' => $categories,
			]);
		}
	}

	/**
	 * Deletes an existing WorkCategory model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
        $model = $this->findModel($id);

        $model->delete();

		return $this->redirect(['index']);
	}

    /**
     * Finds the WorkCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WorkCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WorkCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
