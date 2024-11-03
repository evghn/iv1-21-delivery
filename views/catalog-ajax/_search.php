<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ProductSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'id' => 'form-filter',
        'action' => ['index'],
        'method' => 'get',        
    ]); ?>

    <div class="d-flex align-items-end gap-3">
        <?= $form->field($model, 'title') ?>

        <?= $form->field($model, 'category_id')->dropdownList($categoryes, ['prompt' => 'Выберете категорию']); ?>

        <div class="form-group">           
            <?= Html::a('Сброс', ['/catalog'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    </div>



    <?php ActiveForm::end(); ?>

</div>