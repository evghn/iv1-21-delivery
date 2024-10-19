<?php

namespace app\modules\admin;

use app\models\Role;
use Yii;
use yii\filters\AccessControl;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    
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
                        'roles' => ['@'],
                        'matchCallback' => fn() => Yii::$app->user->identity->isAdmin,
                    ],
                    // всё остальное по умолчанию запрещено
                ],

                'denyCallback' => fn() => Yii::$app->response->redirect('/'),
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
