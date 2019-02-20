<?php
/**
 * Created by Ed.Creater <ed.creater@gmail.com>.
 * Author Site: https://codesweet.ru
 * Date: 27.02.2018
 */

namespace backend\controllers;

use backend\models\search\WorkSearch;
use common\models\Work;
use common\models\WorkCategory;
use common\models\Seofield;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * WorkController implements the CRUD actions for Work model.
 */
class WorkController extends Controller
{

	public function actions(){
		return [
			'upload-image'=>[
				'class'=>'trntv\filekit\actions\UploadAction',
				'fileStorage' => 'imageStorage', // будет вызван Yii::$app->get('flashStorage')
				'deleteRoute' => 'delete-image'
			],
			'delete-image' => [
				'class' => 'trntv\filekit\actions\DeleteAction',
				'fileStorage' => 'imageStorage', // будет вызван Yii::$app->get('flashStorage')
			],
			'upload-thumb'=>[
				'class'=>'trntv\filekit\actions\UploadAction',
				'fileStorage' => 'thumbStorage', // будет вызван Yii::$app->get('flashStorage')
				'deleteRoute' => 'delete-thumb'
			],
			'delete-thumb' => [
				'class' => 'trntv\filekit\actions\DeleteAction',
				'fileStorage' => 'thumbStorage', // будет вызван Yii::$app->get('flashStorage')
			],

		];
	}

	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post']
				]
			]
		];
	}

	/**
	 * Lists all Work models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new WorkSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->sort = [
			'defaultOrder' => ['published_at' => SORT_DESC]
		];
		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider
		]);
	}

	/**
	 * Creates a new Work model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Work();

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
				'categories' => WorkCategory::find()->active()->all(),
			]);

		}
	}

	/**
	 * Updates an existing Work model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
        $seofield = $model->seofield;

		if ($model->load(Yii::$app->request->post()) && $seofield->load(Yii::$app->request->post())) {

            if ($model->save() && $seofield->save()) {
                return $this->redirect(['index']);
            } else {
                throw new ServerErrorHttpException(Yii::t('test', 'Updating your data has go wrong'));
            }

        } else {

			return $this->render('update', [
				'model' => $model,
				'categories' => WorkCategory::find()->active()->all(),
			]);

		}
	}

	/**
	 * Deletes an existing Work model.
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
     * Finds the Work model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Work the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Work::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the Work model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Work the loaded model
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
