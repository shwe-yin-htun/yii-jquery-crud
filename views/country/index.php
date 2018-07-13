<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\UrlManager;
// $pub = Yii::$app->assetManager->publish(__DIR__ . '\js\create.js');
// $this->registerJsFile($pub[1], ['depends' => ['yii\web\JqueryAsset']]);
/* @var $this yii\web\View */
/* @var $searchModel app\models\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
echo Yii::$app->getUrlManager()->parseUrl();

$this->title = 'Countries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Create Country', ['class' => 'btn btn-success','id'=>'create-country']) ?>
    </p>

    <?= GridView::widget([
        'filterModel' => $searchModel,
        'dataProvider' => $dataProvider,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'code',
            'description:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

      <div class="modal fade modal-sm " id="country-modal">
            <div class="modal-dialog">
              <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                   <h4 class="modal-title">Create Country</h4>
                   <button type="button" style="margin-top:-4%" class="close" data-dismiss="modal">×</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" placeholder="Country Name">
                        <span style="color:red" id="name_err"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="code" placeholder="Country Name">
                        <span style="color:red" id="code_err"></span>
                    </div>
                    <div class="form-group">
                        <textarea cols="30" rows="10" class="form-control" id="des" placeholder="Description"></textarea>
                        <span style="color:red" id="des_err"></span>
                    </div>
                    <button class="btn btn-primary" id="save" data-id="">
                       <i class="fa fa-floppy-o" aria-hidden="true"></i> Save
                    </button>
                </div>
                
              </div>
            </div>
        </div>
</div>

     
