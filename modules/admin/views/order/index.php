<?php

use app\models\Order;
use app\models\Status;
use app\widgets\Alert;

use yii\bootstrap5\Modal;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\web\JqueryAsset;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\admin\models\OrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

<h3>Панель администратора</h3>
    <p>
       <?= Html::a('Управление категориями', ['category/index'], ['class' => 'btn btn-primary']) ?>
       <?= Html::a('Управление товарами', ['product/index'], ['class' => 'btn btn-info']) ?>
    </p>

    <div class="pt-5 px-3">
        <h4>Управление заказами</h4>
    </div>

    

    <?php Pjax::begin([
        'id' => 'admin-order-pjax',
        'enablePushState' => false,
        'timeout' => 5000,
    ]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        // is set flash on modal
        if(Yii::$app->session->hasFlash('order-cancel-info')) {
            Yii::$app->session->setFlash('info', Yii::$app->session->getFlash('order-cancel-info'));
            Yii::$app->session->removeFlash('order-cancel-info');
            echo Alert::widget();
        }   
    ?> 

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'headerOptions' => [
                    'width' => 100
                ],
            ],
            [
                'label' => "Дата и время заказа",
                'value' => fn($model) => 
                    Yii::$app->formatter->asDate($model->date, "dd.MM.yyyy")
                        . " " 
                        . $model->time,
            ],
            [
                'attribute' => 'user_id',
                'value'  => fn($model) => $model->user->fio,
            ],
            [
                'attribute' => 'type_pay_id',
                'value'  => fn($model) => $model->typePay->title,
                'filter' => $typePay,
            ],
            //'address',
            //'outpost_id',
            //'comment',
            [
                'attribute' => 'status_id',
                'value'  => fn($model) => $model->status->title,
                'filter' => $statusList,
            ],         
            [
                'label' => "Действия", 
                'format' => 'raw',
                'value' => function ($model) {
                    $btn_view = Html::a("Просмотр", ['view', 'id' => $model->id], ['class' => "btn btn-primary mx-2"]);
                    $btn_apply = '';
                    $btn_cancel = '';
                    $btn_cancel2 = '';
                    if ($model->status->id == Status::getStatusId('Новый')) {
                        $btn_apply = Html::a("Подтвердить", ['apply', 'id' => $model->id], ['class' => "btn btn-success"]);
                        $btn_cancel = Html::a("Отменить", ['cancel', 'id' => $model->id], ['class' => "btn btn-warning mx-2 my-2"]);
                        $btn_cancel2 = Html::a("Отменить (modal)", ['cancel-modal', 'id' => $model->id], ['class' => "btn btn-warning mx-2 my-2 btn-cancel-modal"]);
                    }                   

                    return $btn_view . $btn_apply . $btn_cancel . $btn_cancel2;
                }
            ],

        ],
    ]); ?>


    <?php Pjax::end(); ?>

</div>
<?php

    if ($dataProvider->count) {
        Modal::begin([
            'id' => 'cancel-modal',
            'title' => 'Отмена заказа',
            'size' => 'modal-lg',
            
        ]);
            echo $this->render('form-modal', compact('model_cancel'));
            
        Modal::end();  
        
        
        /* 
            вариант модального окна с формой регистрации и входа
        Modal::begin([
            'id' => 'modal-login-register',
            'title' => '',
            'size' => 'modal-lg',
            
        ]);
            echo $this->render('login-modal', compact('model_login'));
            
            //d-none
            echo $this->render('register-modal', compact('model_register'));

            
            echo Html::a('Вход', '', ['class' => 'd-none btn btn-default btn-login'] );
            
            
            
            echo Html::a('Регистрация', '', ['class' => 'btn btn-default btn-register'] );
            //click 

            //d-none
            echo $this->render('login-modal', compact('model_login'));
            echo Html::a('Регистрация', '', ['class' => 'btn btn-default btn-register'] );
            
            //
            echo $this->render('register-modal', compact('model_register'));
            echo Html::a('Вход', '', ['class' => 'd-none btn btn-default btn-login'] );
            
        Modal::end();  
         */
        
    
        $this->registerJsFile('/js/cancel-modal.js', ['depends' => JqueryAsset::class]);
    }
?>
