<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;

/**
 * Admin controller for the `admin` module
 */
class AdminController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
