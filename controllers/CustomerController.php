<?php

namespace app\controllers;

use Yii;
use app\models\Customers;
use app\models\SearchCustomer;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CustomerController implements the CRUD actions for Customers model.
 */
class CustomerController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Customers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchCustomer();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customers model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {   
        $model = Customers::findOne($id) ;
        if($model!=null){
            return json_encode(['result'=>true,'data'=>$model->attributes]);
        }else{
            return json_encode(['result'=>false,'data'=>'The requested page does not exist.']);
        }

    }

    /**
     * Creates a new Customers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Customers();
        $model->setAttributes(Yii::$app->request->post(), false);
        if($model->validate() && $model->save())
        { 
            return json_encode(['result'=>true,'data'=>Yii::$app->request->post(),'id'=>$model->id,'method'=>'create']);
        }else{
            return json_encode(['result'=>false,'errors'=>$model->errors]);
        }
    }

    /**
     * Updates an existing Customers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setAttributes(Yii::$app->request->post(), false);
        if ($model->validate() && $model->save()) {
            return json_encode(['result'=>true,'data'=>$model->attributes,'method'=>'update']);

        }else{
            return json_encode(['result'=>false,'errors'=>$model->errors]);
        }

    }

    /**
     * Deletes an existing Customers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if( $this->findModel($id)->delete() ) {
            return json_encode(['result'=>true]);
        }else{
            return json_encode(['result'=>false]);
        }
    }

    /**
     * Finds the Customers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
