<?php

namespace backend\controllers;

use common\models\Work;
use common\models\WorkMeta;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

/**
 * WorkMetaController implements the CRUD actions for WorkMeta model.
 */
class WorkMetaController extends Controller
{

    public function getViewPath()
    {
        return $this->module->getViewPath() . DIRECTORY_SEPARATOR . 'work/meta';
    }

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
     * Creates a new WidgetCarouselItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($work_id)
    {
        $model = new WorkMeta();
        $work = Work::findOne($work_id);
        if (!$work) {
            throw new HttpException(400);
        }

        $model->work_id = $work->id;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('alert', ['options' => ['class' => 'alert-success'], 'body' => Yii::t('backend', 'Carousel slide was successfully saved')]);
                return $this->redirect(['/work/update', 'id' => $model->work_id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'work' => $work,
        ]);
    }

    /**
     * Updates an existing WorkMeta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('alert', ['options' => ['class' => 'alert-success'], 'body' => Yii::t('backend', 'Carousel slide was successfully saved')]);
            return $this->redirect(['/work/update', 'id' => $model->work_id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the WorkMeta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WorkMeta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WorkMeta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Deletes an existing WorkMeta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->delete()) {
            return $this->redirect(['/work/update', 'id' => $model->work_id]);
        };
    }
}
