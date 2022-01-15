<?php

namespace app\controllers;

use app\models\Map;
use app\models\Cell;
use app\models\MapSearch;
use app\models\Answer;
use app\models\AnswerSearch;
use app\models\CellSearch;
use app\models\ShiftSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MapController implements the CRUD actions for Map model.
 */
class MapController extends Controller
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
     * Lists all Map models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MapSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
            'answer1Index' => $this->renderAnswerIndex($model, 1),
            'answer2Index' => $this->renderAnswerIndex($model, 2),
            'cellIndex' => $this->renderCellIndex($model),
            'shiftIndex' => $this->renderShiftIndex($model)
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
            'answerPositions1' => Answer::getAnswerPositions1($model->id),
            'answerPositions2' => Answer::getAnswerPositions2($model->id),
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

        return $this->render('create', [
            'model' => $model,
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

        return $this->render('update', [
            'model' => $model,
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
