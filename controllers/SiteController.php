<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegisterForm;
use Symfony\Component\VarDumper\VarDumper as VarDumperVarDumper;
use yii\helpers\VarDumper;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

//http://iv1-21-delivery/    site  /  about

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],            
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->setFlash('success', "Пользователь успешно авторизован в системе");
            return $this->redirect(
                Yii::$app->user->identity->isAdmin
                    ? '/admin'//'/admin-panel'
                    : '/account'
            );
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        Yii::$app->session->setFlash('info', "Вы упешно вышли из системы!");

        return $this->goHome();
    }

    

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    //url: my-page  --> actionMyPage
    public function actionMyPage()    
    {
        return $this->render('my-page');
    }


    public function actionRegister()
    {
        $model = new RegisterForm();

        if (Yii::$app->request->isPost && $model->load($this->request->post())) {
            // VarDumper::dump($model->attributes, 10, true); 
            // VarDumperVarDumper::dump($model->attributes); 
            // die;            
            if ($user = $model->userRegister()) {                
                Yii::$app->user->login($user, 3600*24*30);
                Yii::$app->session->setFlash('success', "Пользователь успешно зарегистрирован");
                return $this->redirect('/account');
            }
        }

        return $this->render('register', compact('model'));
    }
}
