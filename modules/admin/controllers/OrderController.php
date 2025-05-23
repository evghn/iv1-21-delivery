<?php

namespace app\modules\admin\controllers;

use app\models\Order;
use app\models\Status;
use app\models\TypePay;
use app\modules\admin\models\OrderSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
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
     * Lists all Order models.
     *
     * @return string
     */
    public function actionIndex($bg_color = null, $text = null)
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $statusList = Status::getStatusList();
        $typePay = TypePay::getTypePay();

        $model_cancel = null;
        if ($dataProvider->count) {
            // VarDumper::dump($dataProvider->models, 10, true); die;
            $model_cancel = $this->findModel($dataProvider->models[0]->id);
            $model_cancel->scenario = Order::SCENARIO_CANCEL;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'statusList' => $statusList,
            'typePay' => $typePay,
            'model_cancel' => $model_cancel,
            'text' => $text,
            'bg_color' => $bg_color,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionApply($id)
    {
        $text = "";
        $bg_color = "";
        if ($model = Order::findOne($id)) {
            // if ($model->status_id == Status::getStatusId('Новый')) {
                $model->status_id = Status::getStatusId('Готовый к выдаче');
                if (!$model->save()) {
                    var_dump($model->errors); die;
                }
                $text = "Заказ №{$model->id} успешно выполнен!";
                $bg_color = "bg-success";
                /*
                [
                    'id' => 2,
                    'bg_color' => 'green',
                    'text' => "ok"
                ]
                
                * */
                // Yii::$app->session->setFlash('success', "Статус заказ №$model->id изменен на - \"Готов к выдаче\"!");
            // }
        } else { 
            var_dump($model); die;
        }

        // return $this->redirect(['index']);
        return $this->actionIndex($bg_color, $text);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCancel($id)
    {
        $model = $this->findModel($id);
        $model->scenario = Order::SCENARIO_CANCEL;

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->status_id = Status::getStatusId('Отмена');
            if ($model->save()) {
                Yii::$app->session->setFlash('info', "Статус заказ №$model->id изменен на - \"Отменен\"!");
                // return $this->redirect(['view', 'id' => $model->id]);
                return $this->redirect(['view', 'id' => $model->id]);
                
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionCancelModal($id)
    {
        $model = $this->findModel($id);
        $model->scenario = Order::SCENARIO_CANCEL;

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->status_id = Status::getStatusId('Отмена');
            if ($model->save(false)) {
                Yii::$app->session->setFlash('order-cancel-info', "Статус заказ №$model->id изменен на - \"Отменен\"!");
                $model->comment_admin = null;
                return $this->render('form-modal', [
                    'model_cancel' => $model
                ]);
            } else {
                VarDumper::dump($model->errors, 10, true); die;
            }
        }

        // return $this-> render('update', [
        //     'model' => $model,
        // ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
