<?php

namespace app\modules\adminlte\controllers;

use app\models\LoginForm;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `adminlte` module
 */
class LoginController extends Controller
{

    public $layout = 'login';

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->setFlash('success', "Администратор успешно авторизован в системе");
            return $this->redirect(['/admin-lte']);
        }

        $model->password = '';
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
