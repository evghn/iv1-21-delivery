<?php

namespace app\modules\adminlte;

use Yii;
use yii\filters\AccessControl;

/**
 * adminlte module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\adminlte\controllers';

    public $layout = 'admin-lte';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                // 'only' => ['create', 'update'],
                'rules' => [
                    // разрешаем аутентифицированным пользователям
                    [
                        'allow' => true,
                        'controllers' => ['admin-lte/login'],
                        'actions' => ['index'],
                        'roles' => ['?'],                        
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => fn() => Yii::$app->user->identity->isAdmin,
                    ],
                    // всё остальное по умолчанию запрещено
                ],

                'denyCallback' => fn() => Yii::$app->response->redirect('/admin-lte/login'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
