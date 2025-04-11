<?php

use app\models\Outpost;
use app\models\TypePay;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\web\JqueryAsset;
use yii\web\YiiAsset;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\Order $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-form">

    <?php Pjax::begin([
        'id' => 'order-pjax',
        'enablePushState' => false,
        'enableReplaceState' => false,
        'timeout' => 5000,
    ]) ?>

        <?php $form = ActiveForm::begin([
            'id' => 'form-order',           
        ]); ?>
  
            <?= $form->field($model, 'date')->textInput(['type' => 'date', 'min' => date('Y-m-d', strtotime('+1 day'))]) ?>

            <?= $form->field($model, 'date')->textInput(['type' => 'date', 'min' => date('Y-m-d', time() + 3600*24)]) ?>

            <?= $form->field($model, 'time')->textInput(['type' => 'time']) ?>
            <?= $form->field($model, 'year')->widget(\yii\widgets\MaskedInput::class, [
    'mask' => '9999',
]) ?>

            <?= $form->field($model, 'type_pay_id')->dropDownList(TypePay::getTypePay(), ['prompt' => 'Выберете способ оплаты']) ?>
            <div class="alert alert-primary alert-pay d-none" role="alert">Необходимо наличе устройства с возможностью сканирования QR кода</div>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'outpost_id')->dropDownList(Outpost::getOutpost(), ['prompt' => 'Выберете пункт выдачи', 'disabled' => (bool)$model->check]) ?>

            <?= $form->field($model, 'check')->checkbox() ?>

            <?= $model->check ? $form->field($model, 'comment')->textInput(['maxlength' => true]) : '' ?>
            
            <?php #  $form->field($model, 'comment')->textInput(['maxlength' => true, 'disabled' => ! (bool)$model->check]) ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

        <?php ActiveForm::end(); ?>

    <?php Pjax::end() ?>

</div>

<?php
    $this->registerJsFile('/js/order3.js', ['depends' => YiiAsset::class]);
?>
