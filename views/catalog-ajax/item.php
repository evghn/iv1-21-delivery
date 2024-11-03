<?php

use yii\bootstrap5\Html;
?>
<div class="card mb-3" style="width: 18rem;">
    <?= Html::a('<img src="/img/' . ($model->photo ?? $model::NO_PHOTO) . '" class="card-img-top" alt="product">', ['view', 'id' => $model->id]) ?>
  <div class="card-body">
    <?= Html::a("<h4 class=\"card-title\">$model->title</h4>", ['view', 'id' => $model->id], ['class' => 'link-dark text-decoration-none'])?>
    <h6 class="card-subtitle mb-2 text-body-secondary"><?= $model->category->title ?></h6>
    <div class="d-flex justify-content-between align-items-end mb-3">
        <div class="card-text fs-4 fw-semibold"><?= $model->price ?> ꝑ</div>
        <div class="d-flex" >
            <?= $model->count ?> шт.
        </div>
    </div>
    <div class="d-flex justify-content-between  align-items-end">
      <?= Html::a('Просмотр', ['view', 'id' => $model->id], [ 'class' => "btn btn-primary"]) ?>
      <?= Html::a('👍' . "<span class='count-action'>$model->like</span>", ['reaction', 'id' => $model->id, 'like' => 1], [ 'class' => "text-decoration-none btn-reaction"]) ?>
      <?= Html::a('👎' . "<span class='count-action'>$model->dislike</span>", ['reaction', 'id' => $model->id, 'like' => 0], [ 'class' => "text-decoration-none btn-reaction"]) ?>
      
      
      <?= (! Yii::$app->user->isGuest && ! Yii::$app->user->identity->isAdmin)
            ? Html::a(
              empty($model->favourites[0]->status) 
                ? '🤍'
                : '❤'
              // , ['favourite', 'id' => $model->id], ['data-id' => $model->id, 'class' => "text-decoration-none btn-favourites favourites"])
              , ['favourite-post'], ['data-id' => $model->id, 'class' => "text-decoration-none btn-favourites favourites"])
            : ""
      ?>
    </div>
  </div>
</div>