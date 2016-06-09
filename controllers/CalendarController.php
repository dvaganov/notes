<?php

namespace app\controllers;

use Yii;
use app\models\Calendar;
use app\models\Access;
use app\models\search\CalendarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CalendarController implements the CRUD actions for Calendar model.
 */
class CalendarController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Calendar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CalendarSearch();
        $access = Access::find()->whereGuest(\Yii::$app->user->id)->all();

        $dataProviderMy = $searchModel->byOwner(\Yii::$app->user->id);
        $dataProviderShared = $searchModel->searchShared($access);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProviderMy' => $dataProviderMy,
            'dataProviderShared' => $dataProviderShared,
        ]);
    }

    /**
     * @return mixed
     */
     public function actionMy()
     {
         $searchModel = new CalendarSearch();
         $dataProvider = $searchModel->byOwner(\Yii::$app->user->id);

         return $this->render('my', [
             'searchModel' => $searchModel,
             'dataProvider' => $dataProvider,
         ]);
     }

     /**
      * @return mixed
      */
      public function actionShared()
      {
          $searchModel = new CalendarSearch();
          $access = Access::find()->whereGuest(\Yii::$app->user->id)->all();

          $dataProvider = $searchModel->searchShared($access);

          return $this->render('shared', [
              'searchModel' => $searchModel,
              'dataProvider' => $dataProvider,
          ]);
      }

    /**
     * Displays a single Calendar model.
     * @param int $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $view = '';

        switch(Access::check($model)) {

            case Access::ACCESS_OWNER:
                $view = 'viewCreator';
                break;

            case Access::ACCESS_GUEST:
                $view = 'viewGuest';
                break;

            case Access::ACCESS_NO:
            default:
                throw new \yii\web\ForbiddenHttpException("Not allowed!");
        }

        return $this->render($view, [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Calendar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Calendar();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Calendar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (!Access::isCreator($model)) {
            throw new \yii\web\ForbiddenHttpException("Not allowed!");
            return;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Calendar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id);

        if (Access::isCreator($model)) {
            $model->delete();
        } else {
            throw new \yii\web\ForbiddenHttpException("Not allowed!");
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Calendar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Calendar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Calendar::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
