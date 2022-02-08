<?php

namespace app\controllers;

use app\models\Map;
use app\models\Cell;
use app\models\MapSearch;
use app\models\MapCompanySearch;
use app\models\Answer;
use app\models\AnswerSearch;
use app\models\CellSearch;
use app\models\ShiftSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use app\models\User;

/**
 * MapController implements the CRUD actions for Map model.
 */
class MapController extends Controller
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
                        [
                            'actions' => ['index', 'select', 'view'],
                            'allow' => true,
                            'roles' => ['@'],                            
                        ],
                    ]
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
     * Lists all Map models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MapSearch();
        $isAdmin = $this->isAdmin();
        if(!$isAdmin) {
            $searchModel->companyId = \Yii::$app->user->identity->user->company_id;
        }
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'sizes' => Map::getSizeList(),
            'isAdmin' => $isAdmin,
        ]);
    }

    /**
     * Displays a single Map model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(!$this->isAdmin()) {
            $this->redirect(['select', 'id' => $id]);
        }
        $model = $this->findModel($id);
        return $this->render('view', [            
            'model' => $model,
            'companyIndex' => $this->renderCompanyIndex($model),
            'answer1Index' => $this->renderAnswerIndex($model, 1),
            'answer2Index' => $this->renderAnswerIndex($model, 2),
            'cellIndex' => $this->renderCellIndex($model),
            'shiftIndex' => $this->renderShiftIndex($model),            
        ]);
    }    
    
    /**
     * Lists all Answer models.
     *
     * @return string
     */
    private function renderCompanyIndex(Map $model)
    {
        $searchModel = new MapCompanySearch();
        $searchModel->map_id = $model->id;        
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->renderPartial('/map-company/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Lists all Answer models.
     *
     * @return string
     */
    private function renderAnswerIndex(Map $model, int $question)
    {
        $searchModel = new AnswerSearch();
        $searchModel->map_id = $model->id;
        $searchModel->question = $question;
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->renderPartial('/answer/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Lists all Cell models.
     *
     * @return string
     */
    private function renderCellIndex(Map $model)
    {
        $searchModel = new CellSearch();
        $searchModel->mapId = $model->id;
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->renderPartial('/cell/index', [
            'searchModel' => $searchModel,
            'map' => $model,
            'dataProvider' => $dataProvider,
            'cellCodes' =>  Cell::getCodeList($model->id),
        ]);
    }
    
    /**
     * Lists all Shift models.
     *
     * @return string
     */
    public function renderShiftIndex(Map $model)
    {
        $searchModel = new ShiftSearch();
        $searchModel->mapId = $model->id;
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->renderPartial('/shift/index', [
            'searchModel' => $searchModel,
            'map' => $model,
            'dataProvider' => $dataProvider,
            'cellCodes' => Cell::getCodeList($model->id)
        ]);
    }
    
    public function actionSelect($id) {
        $model = $this->findModel($id);
        return $this->render('select', [
            'model' => $model,
            'answers1' => Answer::getAnswerList($model->id, 1, true),
            'answers2' => Answer::getAnswerList($model->id, 2, true),
            'cellCodes' => Cell::getCodeList($model->id)
        ]);
    }

    /**
     * Creates a new Map model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Map();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('form', [
            'model' => $model,
            'sizes' => Map::getSizeList()
        ]);
    }

    /**
     * Updates an existing Map model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('form', [
            'model' => $model,
            'sizes' => Map::getSizeList()
        ]);
    }

    /**
     * Deletes an existing Map model.
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
     * Finds the Map model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Map the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Map::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
