<?php

use yii\bootstrap5\Html;
?>
<div class="card">
  <div class="card-body">

    <div class='d-flex gap-3'>        
        <?= Html::img('/img/' . $model->product->photo, ['class' => 'img_cart_product']) ?>
        <div class="d-flex flex-column">
            <?= Html::a($model->product->title, ['catalog/view', 'id' => $model->product_id], ['data-pjax' => 0]) ?>
            <div>
                Цена: <?= $model->product->price ?>
            </div>
        </div>
    </div>
    <div class='d-flex justify-content-between mt-3'>
        <div>
            <?= Html::a('Удалить', ['cart/remove-item', 'item_id' => $model->id], ['class' => 'btn btn-outline-danger btn-cart-item-remove' ]) ?>
        </div>
        <div class='d-flex justify-content-end gap-3'>
            <?= Html::a('-', ['cart/dec-item', 'item_id' => $model->id], ['class' => 'btn btn-outline-danger btn-cart-item-dec']) ?>
            <!-- проверка на кол-во в магазине -->
            <?= $model->product_amount ?>
            <?= Html::a('+', ['cart/inc-item', 'item_id' => $model->id], ['class' => 'btn btn-outline-success btn-cart-item-inc']) ?>
            
            <div>
                Итого: <?= $model->total_amount ?> ꝑ
            </div>
        </div>
    </div>
  </div>
</div>