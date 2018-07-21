<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchCustomer */
/* @var $dataProvider yii\data\ActiveDataProvider */
$create_route =  Yii::$app->urlManager->createUrl('/customer/create');
$view_route =  Yii::$app->urlManager->createUrl('/customer/view');
$update_route =  Yii::$app->urlManager->createUrl('/customer/update');
$delete_route =  Yii::$app->urlManager->createUrl('/customer/delete');
$token = Yii::$app->request->getCsrfToken();
echo "<input type='hidden' id='create-route' value='".$create_route."'>";
echo "<input type='hidden' id='view-route' value='".$view_route."'>";
echo "<input type='hidden' id='update-route' value='".$update_route."'>";
echo "<input type='hidden' id='delete-route' value='".$delete_route."'>";

echo "<input type='hidden' id='token' value='".$token."'>";
$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Create Customers', ['class' => 'btn btn-success','id'=>'create-customer']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'email:email',
            'password',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{view}{update}{delete}',
                'buttons' => [
                  'view' => function ($url,$model) {
                      return Html::button('<span class="glyphicon glyphicon-eye-open"></span>', [
                                  'title' => Yii::t('app', 'customer-view'),'id'=>'view', 'data-id'=>$model->id
                      ]);
                  },
      
                  'update' => function ($url,$model) {
                      return Html::button('<span class="glyphicon glyphicon-pencil"></span>', [
                                  'title' => Yii::t('app', 'customer-update'),'id'=>'edit','data-id'=>$model->id
                      ]);
                  },
                  'delete' => function ($url,$model) {
                      return Html::button('<span class="glyphicon glyphicon-trash"></span>', [
                                  'title' => Yii::t('app', 'customer-delete'),'id'=>'delete','data-id'=>$model->id
                      ]);
                  }
                ],
            ], 
        ]   
    ]); ?>
</div>

       <div class="modal fade modal-sm " id="customer-modal">
            <div class="modal-dialog">
              <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                   <h4 class="modal-title"></h4>
                   <button type="button" style="margin-top:-4%" class="close" data-dismiss="modal">×</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="username" placeholder="Username">
                        <span style="color:red" id="name_err"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" placeholder="Email">
                        <span style="color:red" id="email_err"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" placeholder="Password">
                        <span style="color:red" id="pwd_err"></span>
                    </div>
                    <button class="btn btn-primary" id="save" data-id="">
                       <i class="fa fa-floppy-o" aria-hidden="true"></i> Save
                    </button>
                </div>
                
              </div>
            </div>
        </div>
