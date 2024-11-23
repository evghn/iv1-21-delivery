<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

 $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="d-flex align-items-end gap-3">
        <?= $form->field($model, 'product_title') ?>

        <?= $form->field($model, 'product_category')->dropdownList($categoryes, ['prompt' => 'Все категории']); ?>

        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Сброс', ['/account/favourite'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>