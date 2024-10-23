<?php

use yii\bootstrap5\Html;
use yii\helpers\VarDumper;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title = "Товар: " . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


// VarDumper::dump($model->attributes, 10, true);
// VarDumper::dump($categoryes, 10, true); 
// die;
?>
<div class="product-view">

    <h3><?= Html::encode($this->title) ?></h3>
    <p>
        <?= Html::a('Назад', ['index'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Редактирование', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удаление', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы точно хотите удалить данный товар?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
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
            [
                'attribute' => 'photo',
                'value' => Html::img("/img/" . $model->photo, ['class' => 'w-25', 'alt' => 'product']),
                'format' => 'html'
            ],
            
            // 'photo',
        ],
    ]) ?>

</div>
