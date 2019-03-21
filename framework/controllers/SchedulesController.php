<?php

namespace app\controllers;

use app\models\Schedules;
use app\models\SchedulesSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;


use app\models\Days;

/**
 * SchedulesController implements the CRUD actions for Schedules model.
 */
class SchedulesController extends Controller
{



    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['view','create','update','delete'],
                'rules' => [
                    [
                        'actions' => ['view','create','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Schedules models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new SchedulesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Schedules model.
     * @param  string                $id
     * @throws NotFoundHttpException if the model cannot be found
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Schedules model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Schedules();

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            foreach (Days::$days_of_week as $k => $v) {
                $modelDays = Days::find()->where(["id_schedule" => $model->id,"day_of_week"=>$k])->one();
                if (in_array($k,$model->days))
                {
                    if (!$modelDays)
                    {
                        
                        $modelDays = new Days();
                        $modelDays->id_schedule = $model->id;
                        $modelDays->day_of_week = $k;
                        $modelDays->validate();
                        $modelDays->save(); //false
                    }
                }
                else
                {
                    if ($modelDays)
                    {
                        $modelDays->delete();
                    }
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model'         => $model,
        ]);
    }

    /**
     * Updates an existing Schedules model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param  string                $id
     * @throws NotFoundHttpException if the model cannot be found
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {            
            foreach (Days::$days_of_week as $k => $v) {
                $modelDays = Days::find()->where(["id_schedule" => $model->id,"day_of_week"=>$k])->one();
                if (in_array($k,$model->days))
                {
                    if (!$modelDays)
                    {
                        
                        $modelDays = new Days();
                        $modelDays->id_schedule = $model->id;
                        $modelDays->day_of_week = $k;
                        $modelDays->validate();
                        $modelDays->save(); //false
                    }
                }
                else
                {
                    if ($modelDays)
                    {
                        $modelDays->delete();
                    }
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model'         => $model,
        ]);
    }

    /**
     * Deletes an existing Schedules model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param  string                $id
     * @throws NotFoundHttpException if the model cannot be found
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Schedules model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param  string                $id
     * @throws NotFoundHttpException if the model cannot be found
     * @return Schedules             the loaded model
     */
    protected function findModel($id)
    {
        if (($model = Schedules::findOne($id)) !== null)
        {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
