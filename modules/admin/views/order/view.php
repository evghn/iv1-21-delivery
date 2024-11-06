<?php

use app\models\Status;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->title = "Покупка: " . $model->product->title;
?>
<div class="order-view">

    <h3><?= Html::encode($this->title) ?></h3>
    <p>
        <?= Html::a('Назад', ['index'], ['class' => 'btn btn-info']) ?>        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => "Дата покупки",                
                'value' => Yii::$app->formatter->asDatetime($model->created_at, "php:d.m.Y H:i:s"),
            ],
            [
                'label' => "Покупатель",
                'attribute' => 'user_id',
                'value' => fn($model) => $model->user->fio
            ],
            
            [
                'attribute' => 'product_id',
                'value' => $model->product->title,
            ],
            'date',
            'time',
            'address',
            [
                'attribute' => 'outpost_id',
                'value' => $model->outpost->title,
            ],
            [
                'attribute' => 'type_pay_id',
                'value' => $model->typePay->title,
            ],
            [
                'attribute' => 'status_id',
                'value' => $model->status->title,
            ],   
            [
                'attribute' => 'comment',
                'visible' => (bool)$model->comment_admin,
            ],
            [
                'attribute' => 'comment_admin',
                'visible' => (bool)$model->comment_admin,
            ],
        ],
    ]) ?>

</div>
