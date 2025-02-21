<?php

namespace app\modules\account\controllers;

use app\models\Cart;
use app\models\CartItem;
use app\models\OrderShop;
use app\models\OrderShopItem;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;

/**
 * OrderShopController implements the CRUD actions for Cart model.
 */
class OrderShopController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Cart models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = null;
        $cart = null;

        if ($cart = Cart::findOne(['user_id' => Yii::$app->user->id])) {
            $dataProvider = new ActiveDataProvider([
                'query' => CartItem::find(['cart_id' => $cart->id])
                            ->with('product'),                
                'pagination' => [
                    'pageSize' => 5
                ],
            ]);
        } else {
            return $this->redirect('/');
        }


        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'cart' => $cart,
        ]);
    }

    /**
     * Displays a single Cart model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if ($model = OrderShop::findOne($id)) {
            $dataProvider = new ActiveDataProvider([
                'query' => OrderShopItem::find()
                    ->where(['order_id' => $id])
                    ->with('product'),
            ]);
            
            return $this->render('view', [
                'dataProvider' => $dataProvider,
                'model' => $model,
            ]);
        }

        
        Yii::$app->session->setFlash('error', 'Ошибка поиска заказа');
        // redirect на список заказов пользователя
        return $this->redirect('/');
    }

    /**
     * Creates a new Cart model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if ($this->request->isPost) {
           if ($id = OrderShop::orderCreate()) {
                return $this->redirect(['view', 'id' => $id]);
           }
        }

        if (Yii::$app->session->hasFlash('shop')) {
            Yii::$app->session->setFlash('error', 
                Yii::$app->session->getFlash('shop', '', true)
            );
        }
        return $this->redirect('index');
    }
    
}
