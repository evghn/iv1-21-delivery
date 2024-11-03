<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Каталог товаров', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h3>Товар: <?= Html::encode($this->title) ?></h3>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'price',
            'count',
            'weight',
            'kilocalories',
            'shelf_life',
            'description:ntext',
            [
                'attribute' => 'category_id',
                'value' => $categoryes[$model->category_id],
            ],

            // [
            //     'attribute' => 'photo',
            //     'value' => Html::img("/img/" . ($model->photo ?? $model::NO_PHOTO),['class' => 'w-25', 'alt' => 'product']),
            //     'format' => 'html'
            // ],
            [
                'attribute' => 'photo',
                'value' => Html::img("/img/" . $model->photo ,['class' => 'w-25', 'alt' => 'product']),
                'format' => 'html',
                'visible' => (bool)$model->photo,
            ],
            
            // 'photo',
        ],
    ]) ?>

</div>
