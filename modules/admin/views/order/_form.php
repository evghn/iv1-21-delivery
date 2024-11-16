<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Order $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'comment_admin')->textarea()  ?>
    
    <div class="form-group">
        <?= Html::submitButton('Отменить заказ', ['class' => 'btn btn-outline-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
