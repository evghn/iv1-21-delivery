<?php

use app\models\Product;
use yii\bootstrap5\Html;
use yii\bootstrap5\LinkPager;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\CatalogLightSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Каталог товаров (light)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">
    <h3><?= Html::encode($this->title) ?></h3>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{items}\n{pager}",
        'pager' => [
            'class' => LinkPager::class,
        ],
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            
            [
                'attribute' => 'title',
                'format' => 'html',
                'value' => fn($model) => Html::a(
                    Html::img("/img/" . ($model->photo ?? $model::NO_PHOTO), ['class' => 'me-5 w-25', 'alt' => 'product']) 
                        . $model->title, 
                    ['view', 'id' => $model->id], 
                    ['class' => 'text-decoration-none']
                ),
                // 'value' => fn($model) => ($model->photo ? Html::img("/img/" . $model->photo, ['class' => 'me-5 w-25', 'alt' => 'product']) : "") . $model->title,
            ],    
            [
                'attribute' => 'category_id',
                'value' => fn($model) => $categoryes[$model->category_id],
                'filter' => $categoryes,
                'headerOptions' => [
                    'width' => 120,
                    'class' => 'text-center',
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ]
            ],
            [
                'attribute' => 'price',
                'headerOptions' => [
                    'class' => 'text-center'
                ], 
                'contentOptions' => [
                    'class' => 'text-center'
                ]
            ],
            [
                'attribute' => 'count', 
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ]
            ],
            
           
            
            //'weight',
            //'kilocalories',
            //'shelf_life',
            //'description:ntext',            
            
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
