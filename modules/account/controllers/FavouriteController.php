<?php

namespace app\modules\account\controllers;

use app\models\Category;
use app\models\Favourite;
use app\modules\account\models\FavouriteSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FavouriteController implements the CRUD actions for Favourite model.
 */
class FavouriteController extends Controller
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
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Favourite models.
     *
     * @return string
     */
    public function actionIndex($id = null)
    {
        $searchModel = new FavouriteSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        if ($id) {
            if ($model = $this->findModel($id)) {
                //update
                $model->status = (int)(! $model->status);
                $model->save();
                return true;
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categoryes' => Category::getCategoryes(),
        ]);
    }

    /**
     * Displays a single Favourite model.
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
     * Deletes an existing Favourite model.
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
     * Finds the Favourite model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Favourite the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Favourite::findOne([
            'user_id' => Yii::$app->user->id,
            'id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
