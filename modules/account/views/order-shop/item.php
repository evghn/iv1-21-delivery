<?php

use yii\bootstrap5\Html;


?>
<div class="card">
  <div class="card-body">    
    <div class='d-flex gap-3'>        
        <?= Html::img('/img/' . $model->product->photo, ['class' => 'img_cart_product']) ?>
        <div class="d-flex flex-column">
            <?= Html::a($model->product->title, ['/catalog/view', 'id' => $model->product_id], ['data-pjax' => 0]) ?>
            <div>
                Цена: <?= $model->product->price ?>
            </div>
            <div class="<?= $model->product_amount > $model->product->count ? 'bg-danger text-white py-1 px-2' : '' ?>">
                Количество товара <?= $model->product_amount ?>
            </div>
            <div>
                Сумма товара <?= $model->total_amount ?>
            </div>
            
        </div>
    </div>   
  </div>
</div>