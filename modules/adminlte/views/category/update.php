<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Category $model */

$this->title = 'Редактирование категории: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="category-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= Html::a('Назад', ['index', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
