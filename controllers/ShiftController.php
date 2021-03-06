<?php

namespace app\controllers;

use app\models\Map;
use app\models\Cell;
use app\models\Shift;
use app\models\ShiftSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use app\models\User;

/**
 * ShiftController implements the CRUD actions for Shift model.
 */
class ShiftController extends Controller
{
    private function isAdmin(): bool {
        if(Yii::$app->user->isGuest) {
            return false;
        }
        $user = Yii::$app->user->identity->user;
        /* @var $user User*/
        return $user->type == User::TYPE_ADMIN;
    }
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                            'matchCallback' => function()
                            {
                                return $this->isAdmin();                                
                            }
                        ],
                    ],
                ],
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
     * Lists all Shift models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ShiftSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Shift model.
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

    /**
     * Creates a new Shift model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($mapId)
    {
        $model = new Shift();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['/map/view', 'id' => $model->cellStart->answer1->map_id, 'tab' => 'shifts']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('form', [
            'model' => $model,
            'map' => Map::findOne($mapId),
            'cells' => Cell::getCodeList($mapId)
        ]);
    }

    /**
     * Updates an existing Shift model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['/map/view', 'id' => $model->cellStart->answer1->map_id, 'tab' => 'shifts']);
        }        

        return $this->render('form', [
            'model' => $model,
            'map' => $model->cellStart->answer1->map,
            'cells' => Cell::getCodeList($model->cellStart->answer1->map_id)
        ]);
    }

    /**
     * Deletes an existing Shift model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['/map/view', 'id' => $model->cellStart->answer1->map_id, 'tab' => 'shifts']);
    }

    /**
     * Finds the Shift model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Shift the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Shift::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
