<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Order $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="mx-3">
        Покупка товара: 
            <span class="fs-3 text fw-bold">
                <?= $model->product->title ?>
            </span>
    </div>
    <div class="row">
        <div class="col-3">
            <?= $form->field($model, 'date')->textInput(['type' => 'date', 'value' => date("Y-m-d"), 'min' => date("Y-m-d")]) ?>            
        </div>
        <div class=" col-3 ">
            <?= $form->field($model, 'time')->textInput(['type' => "time", 'min' => "09:00",  'max' => "21:00"]) ?>
        </div>
    </div>

    <?= $form->field($model, 'type_pay_id')->dropdownList($typePay,['prompt'=>'Выберете вид оплаты']); ?> 

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'outpost_id')->dropdownList($outpost,['prompt'=>'Выберете пункт выдачи']); ?> 

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>
   
   
    <div class="form-group">
        <?= Html::submitButton('Создать завказ', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
