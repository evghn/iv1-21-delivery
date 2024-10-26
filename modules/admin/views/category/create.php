<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Category $model */

$this->title = 'Создание категории';
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <h3><?= Html::encode($this->title) ?></h3>
    
    <?= Html::a('Назад', ['index', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>