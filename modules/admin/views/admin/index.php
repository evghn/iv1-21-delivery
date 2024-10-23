<?php

use yii\bootstrap5\Html;

?>
<div class="admin-default-index">
    <h3>Панель администратора</h3>
    <p>
       <?= Html::a('Управление категориями', ['category/index'], ['class' => 'btn btn-primary']) ?>
       <?= Html::a('Управление товарами', ['product/index'], ['class' => 'btn btn-info']) ?>
    </p>
    
</div>
