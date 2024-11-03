<?php

namespace app\controllers;

use app\models\Category;
use app\models\Favourite;
use app\models\Product;
use app\models\ProductSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;

/**
 * CatalogController implements the CRUD actions for Product model.
 */
class CatalogAjaxController extends Controller
{
    /**
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex($id = null, $like = null)
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categoryes' => Category::getCategoryes(),
        ]);
    }

    public function actionFavourite($id)
    {
        $model = Favourite::findOne([
            'user_id' => Yii::$app->user->id,
            'product_id' => $id
        ]);

        if (is_null($model)) {
            // insert
            $model = new Favourite();
            $model->user_id = Yii::$app->user->id;
            $model->product_id = $id;
            $model->status = 1;
            // die;
        } else {
            //update
            $model->status = (int)(! $model->status);
        }

        $model->save();

        return  (bool)$model->status;
    }

    public function actionFavouritePost()
    {
        if ($this->request->isPost) {

            $id = $this->request->post('id');
            $model = Favourite::findOne([
                'user_id' => Yii::$app->user->id,
                'product_id' => $id
            ]);

            if (is_null($model)) {
                // insert
                $model = new Favourite();
                $model->user_id = Yii::$app->user->id;
                $model->product_id = $id;
                $model->status = 1;
                // die;
            } else {
                //update
                $model->status = (int)(! $model->status);
            }

            $model->save();

            return  $model->status;
        }
    }


    public function actionReaction($id, $like)
    {
        // like-dislike
        if ($model = Product::findOne($id)) {
            // update
            $result = 0;
            switch ($like) {
                case 1:
                    $model->like++;
                    $result = $model->like;
                    break;
                case 0:
                    $model->dislike++;
                    $result = $model->dislike;
            }

            $model->save();

            return $result;
        }
    }




    /**
     * Displays a single Product model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'categoryes' => Category::getCategoryes(),
        ]);
    }



    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
