<?php

use app\models\Order;
use app\models\Status;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
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

    

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'product_id',
                'value'  => fn($model) => $model->product->title,
            ],
            [
                'label' => "Дата и время заказа",
                'value' => fn($model) => 
                    Yii::$app->formatter->asDate($model->date, "dd.mm.yyyy")
                        . " " 
                        . $model->time,
            ],
            [
                'attribute' => 'type_pay_id',
                'value'  => fn($model) => $model->typePay->title,
            ],
            //'address',
            //'outpost_id',
            //'comment',
            [
                'attribute' => 'status_id',
                'value'  => fn($model) => $model->status->title,
            ],            
            [
                'label' => "Действия", 
                'format' => 'raw',
                'value' => function ($model) {
                    $btn_view = Html::a("Просмотр", ['view', 'id' => $model->id], ['class' => "btn btn-primary mx-2"]);
                    if ($model->status->id == Status::getStatusId('Новый')) {
                        $btn_apply = Html::a("Подтвердить", ['apply', 'id' => $model->id], ['class' => "btn btn-success"]);
                        $btn_cancel = Html::a("Отменить", ['cancel', 'id' => $model->id], ['class' => "btn btn-warning mx-2 my-2"]);
                    }
                    

                    return $btn_view . $btn_apply . $btn_cancel;
                }
            ],

        ],
    ]); ?>


    <?php Pjax::end(); ?>

</div>
