<?php

use app\models\Favourite;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\web\JqueryAsset;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\account\models\FavouriteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Любимые товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="favourite-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <?php Pjax::begin([
        'id' => 'favourite-pjax',
        'timeout' => 5000,
    ]); ?>
    <div class="d-flex justify-content-between">

     <div class="block-link">
            <?= $dataProvider->sort->link('product_title')?> |            
            <?= $dataProvider->sort->link('product_category')?>            
        </div>
        <?= $this->render('_search', [
            'model' => $searchModel,
            'categoryes' => $categoryes
        ]); ?>
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

<?php
    $this->registerJsFile('/js/favourite.js', ['depends' => JqueryAsset::class]);
?>
