<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\LoginForm;
use Yii;

class LoginController extends \yii\web\Controller
{
    public $layout = 'main';

    
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->setFlash('success', "Администратор успешно авторизован в системе");
            return $this->redirect(['/admin-panel']);
        }

        $model->password = '';
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionTest()
    {
        echo 'ok';
        die;
    }

}
