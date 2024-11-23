<?php

use yii\bootstrap5\Html;
?>
<div class="card mb-3" style="width: 18rem;">
    <?= Html::a('<img src="/img/' . ($model->product->photo ?? $model->product::NO_PHOTO) . '" class="card-img-top" alt="product">', ['view', 'id' => $model->id]) ?>
  <div class="card-body">
    <?= Html::a("<h4 class=\"card-title\">" . Html::encode($model->product->title) . "</h4>", ['view', 'id' => $model->id], ['class' => 'link-dark text-decoration-none'])?>
    <h6 class="card-subtitle mb-2 text-body-secondary"><?= Html::encode($model->product->category->title) ?></h6>
    <div class="d-flex justify-content-between align-items-end mb-3">
        <div class="card-text fs-4 fw-semibold"><?= $model->product->price ?> ꝑ</div>
        <div class="d-flex">
            <?= $model->product->count ?> шт.
        </div>
    </div>
    <div class="d-flex justify-content-between  align-items-end">
      <?= Html::a('Просмотр', ['view', 'id' => $model->id], [ 'class' => "btn btn-primary"]) ?>
      
      <?= Html::a(
              empty($model->status) 
                ? '🤍'
                : '❤'
              , ['index', 'id' => $model->id], 
              [
                'data' => [
                  'id' => $model->id,
                   
                  'pjax' => false
                ],
                'class' => "text-decoration-none btn-favourites favourites"
              ])
      ?>
    </div>
    <div class="w-100 mt-2">
        <?= Html::a('Купить', ['/account/order/create', 'product_id' => $model->id], ['class' => 'w-100 btn btn-outline-success'])
        ?>
        <?= Html::a('Купить вариант 2', ['/account/order/create2', 'product_id' => $model->id], ['class' => 'w-100 btn btn-outline-success mt-2'])
        ?>
        <?= Html::a('Купить вариант Pjax', ['/account/order/create3', 'product_id' => $model->id], ['class' => 'w-100 btn btn-outline-success mt-2'])
        ?>
        
    </div>
  </div>
</div>