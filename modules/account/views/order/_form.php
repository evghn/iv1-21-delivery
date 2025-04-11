<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\web\JqueryAsset;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\Order $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin([
        'id' => 'form-order',
    ]); ?>

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

    <?= $form->field($model, 'check')->checkbox() ?>

    <?= $form->field($model, 'comment', ['options' => ['class' => 'd-none mb-3 comment-filed']])->textInput(['maxlength' => true/* , 'disabled' => true */]) ?>   
   
    <div class="form-group">
        <?= Html::submitButton('Создать заказ', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

// $this->registerJsFile('/js/order.js', ['depends' => 'yii\web\JqueryAsset']);
$this->registerJsFile('/js/order.js', ['depends' => JqueryAsset::class]);

?>
