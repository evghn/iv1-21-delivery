<?php

namespace app\controllers;

use app\models\Image;
use yii\helpers\VarDumper;
use yii\web\Controller;

class MyMainController extends Controller
{

    public function actionIndex()
    {
        $imageFile = Image::getImage();

        return $this->render('page', compact('imageFile'));
    }

    public function actionHello()
    {
        $user = 'Vasya';

        return $this->render('user', [
            'user' => $user,
            'name' => 'Patya',
            'login' => 'Kolya',
            'friends' => [
                [],
                [],

            ]
        ]);
    }
}
