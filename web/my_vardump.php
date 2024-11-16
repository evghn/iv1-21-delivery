<?php

use yii\helpers\VarDumper;

function my_dump(...$data) {
    if (! empty($data)) {
        foreach ($data as $val) {
            VarDumper::dump($val, 10, true);    
        }
    } else {
        VarDumper::dump($data, 10, true);
    }

}