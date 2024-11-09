<?php

return $_SERVER["DOCUMENT_ROOT"] == 'E:/OSPanel/domains/iv1-21-delivery'
    ? [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;port=3306;dbname=delivery_21',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',        
    ]
    : [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;port=33061;dbname=delivery_21',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',        
    ];
