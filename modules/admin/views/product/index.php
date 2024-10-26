<?php

use app\models\Product;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\admin\models\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создание товара', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'title',
                'format' => 'html',
                'value' => fn($model) => Html::img("/img/" . ($model->photo ?? $model::NO_PHOTO), ['class' => 'me-5 w-25', 'alt' => 'product']) . $model->title,
                // 'value' => fn($model) => ($model->photo ? Html::img("/img/" . $model->photo, ['class' => 'me-5 w-25', 'alt' => 'product']) : "") . $model->title,


            ],            
            
            'price',
            'count',
            //'like',
            //'dislike',
            //'weight',
            //'kilocalories',
            //'shelf_life',
            //'description:ntext',
            //'category_id',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Product $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
