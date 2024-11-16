<?php

namespace app\modules\account;

use Yii;
use yii\filters\AccessControl;

/**
 * account module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\account\controllers';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,                
                'rules' => [
                    // разрешаем аутентифицированным пользователям
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => fn() => !Yii::$app->user->identity->isAdmin,
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
