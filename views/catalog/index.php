<?php

use app\models\Product;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Каталог товаров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <?php Pjax::begin(); ?>
    
   
    <div class="my-3 d-flex justify-content-between align-items-end">
        <div class="form-group">
            Сортировка:
            <div class="d-flex gap-2 ">
                <?= $dataProvider->sort->link('title') ?> | <?= $dataProvider->sort->link('price') ?> | <?= $dataProvider->sort->link('count') ?> |
                <?= Html::a('сбросить', ['/catalog'], ["class" => "text-decoration-none"]) ?>
            </div>
        </div>
        <div class="d-flex gap-3">
            <?= $this->render('_search', [
                'model' => $searchModel,
                'categoryes' => $categoryes
            ]);  ?>
        </div>
    </div>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "\n<div class=\"d-flex justify-content-between flex-wrap\">{items}</div>\n<div class=\"mt-3\">{pager}</div>",
        'pager' => [
            'class' => LinkPager::class,
        ],
        'itemOptions' => ['class' => 'item'],

        'itemView' => 'item',

    ]) ?>

    <?php Pjax::end(); ?>

</div>