<?php

use app\models\Order;
use app\models\Status;
use app\widgets\Alert;
use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\web\JqueryAsset;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\account\models\OrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <div class="my-3">
        <?= Html::a('Избранное', ['/account/favourite'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('order 1', ['create'], ['class' => 'btn  btn-outline-primary']) ?>
        <?= Html::a('order 2', ['create2'], ['class' => 'btn btn-outline-primary']) ?>
        <?= Html::a('order 3', ['create3'], ['class' => 'btn btn-outline-primary']) ?>
    </div>
    <?php Pjax::begin([
        'id' => 'order-pjax'
    ]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= Alert::widget() ?>

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
                    Yii::$app->formatter->asDate($model->date, "dd.MM.yyyy")
                        . " " 
                        . $model->time,
            ],
            [
                'attribute' => 'type_pay_id',
                'value'  => fn($model) => $model->typePay->title,
                'filter' => $typePay,
                'filterInputOptions' => [
                    'class' => 'form-control',                     
                    'prompt' => 'Все варианты оплаты'
                ],
            ],
            //'address',
            //'outpost_id',
            //'comment',
            [
                'attribute' => 'status_id',
                'value'  => fn($model) => $model->status->title,
                'filter' => $statusList,
                'filterInputOptions' => [
                    'class' => 'form-control',                     
                    'prompt' => 'Все статусы'
                ],
            ],            
            [
                'label' => "Действия", 
                'format' => 'raw',
                'value' => function ($model) {
                    $btn_view = Html::a("Просмотр", ['view', 'id' => $model->id], ['class' => "btn btn-primary mx-2"]);
                    $btn_delete = $model->status->id == Status::getStatusId('Новый')
                        ? Html::a("Удалить", ['delete-modal', 'id' => $model->id], [
                            'class' => 'btn btn-danger btn-confirm',
                            // 'data' => [
                            //     // 'confirm' => 'Вы точно хотите удалить данный заказ?',
                            //     // 'method' => 'post',
                            //     // 'pjax' => 0
                            // ]
                        ])
                        : "";

                    return $btn_view . $btn_delete;
                }
            ],

        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

<?= $this->render('modal', ['pjax' => '#order-pjax']) ?>
