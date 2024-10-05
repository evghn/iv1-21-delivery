<?php

use yii\helpers\VarDumper;

?>
<div>


    Hello <?= $user ?>

    <?php
        VarDumper::dump([
            'user' => $user,
            'name' => 'Patya',
            'login' => 'Kolya',
            'friends' => [
                [],
                [],
            ]
            ], 10, true); ?>

</div>