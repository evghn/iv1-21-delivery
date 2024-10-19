<?php

use yii\bootstrap5\Html;

?>
<div class="admin-default-index">
    <h3>Панель администратора</h3>
    <p>
       <?= Html::a('Управление категориями', ['category/index'], ['class' => 'btn btn-primary']) ?>
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>
