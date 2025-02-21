<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\LinkPager;
use yii\widgets\ListView;
use yii\widgets\Pjax;

use function PHPUnit\Framework\isNull;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div class="order-shop-index">
    <h3 class="mb-3">Заказ №<?= $model->id ?>
     от <?= Yii::$app->formatter->asDate($model->created_at, "php:d.m.Y") ?>
      (<?= Yii::$app->formatter->asTime($model->created_at, "php:H:i:s") ?>)</h3>

    <p>Состав заказа:</p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => 'order-item',
        'pager' => [
            'class' => LinkPager::class,
        ],
        'layout' => "{items}",

    ]) ?>
    <div class="d-flex gap-3 flex-column align-items-end border-bottom border-top">

        <div class="">
            Количество товаров в заказе:
            <span class="fs-3 fw-bold">
                <?= $model->product_amount ?>
            </span>
        </div>
        <div class="">
            Общая сумма заказа: <span class="fs-3 fw-bold"><?= $model->total_amount ?></span>
        </div>

    </div>
</div>