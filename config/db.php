<?php
// var_dump($_SERVER); die;

if ($_SERVER["DOCUMENT_ROOT"] == 'E:/OSPanel/domains/iv1-21-delivery') {
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;port=3306;dbname=delivery_21',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',        
    ];
    
}

if (isset($_SERVER["SERVER_ADDR"]) && $_SERVER["SERVER_ADDR"] != '127.0.0.1') {
     return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=MySQL-8.2;port=3306;dbname=delivery_21',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',        
    ];
}

return  [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;port=33061;dbname=delivery_21',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',        
];
