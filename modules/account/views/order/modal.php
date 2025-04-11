<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use yii\web\JqueryAsset;

$pjax = $pjax ?? 0;
?>

<?php
    Modal::begin([
            'id' => 'confirm-modal',
            'title' =>  'Подтверждение удаления'            
        ]);
?>
    <div>
        Удалить заказ?
    </div>
    <div class='d-flex justify-content-end gap-3'>            
        <?= $pjax 
                ? Html::a('Удалить', '', ['class' => "btn btn-outline-danger btn-delete", 'data-pjx' => $pjax])
               : Html::a('Удалить',  '', ['class' => "btn btn-outline-danger btn-delete", 'data-method' => 'post', 'data-pjx' => 0])
        ?>

         
        <?= Html::a('Отменить', '', ['class' => "btn btn-outline-primary btn-cancel" ]) ?>
        
    </div>

<?php
    Modal::end();

    $this->registerJsFile('/js/modal.js', ['depends' => JqueryAsset::class]);
?>