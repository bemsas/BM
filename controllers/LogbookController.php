<?php

namespace app\controllers;

use app\models\Logbook;
use app\models\LogbookSearch;
use app\models\Contact;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\User;
use Yii;

/**
 * LogbookController implements the CRUD actions for Logbook model.
 */
class LogbookController extends Controller
{
    private function isAdmin(): bool {
        if(Yii::$app->user->isGuest) {
            return false;
        }
        $user = Yii::$app->user->identity->user;
        /* @var $user User*/
        return $user->type == User::TYPE_ADMIN;
    }
    private function isManager(): bool {
        if(Yii::$app->user->isGuest) {
            return false;
        }
        $user = Yii::$app->user->identity->user;
        /* @var $user User*/
        return $user->type == User::TYPE_COMPANY_MANAGER;
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
     * Lists all Logbook models.
     *
     * @return string
     */
    public function actionIndex($all = false)
    {
        $searchModel = new LogbookSearch();        
        if($all && $this->isAdmin()) {     
            $contacts = Contact::getList();
            $users = User::getList();
        } elseif($all && $this->isManager()) {
            $searchModel->company_id = \Yii::$app->user->identity->user->company_id;
            $users = User::getListByCompanyId($searchModel->company_id);
            $contacts = Contact::getListByCompanyId($searchModel->company_id);
        } else {
            $searchModel->user_id = \Yii::$app->user->id;
            $users = false;
            $contacts = Contact::getListByUserId(\Yii::$app->user->id);
        }        
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users' => $users,
            'contacts' => $contacts
        ]);
    }

    /**
     * Displays a single Logbook model.
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
     * Creates a new Logbook model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Logbook();
        $model->user_id = \Yii::$app->user->id;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect($model->fromCell ? ['cell/view', 'id' => $model->cell_id, 'contactId' => $model->contact_id] : ['index']);
            }
        } else {
            $model->loadDefaultValues();
        }
        var_dump($model->errors);

        return $this->render('form', [
            'model' => $model,
            'contacts' => Contact::getListByUserId(\Yii::$app->user->id)
        ]);
    }

    /**
     * Updates an existing Logbook model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('form', [
            'model' => $model,
            'contacts' => Contact::getListByUserId(\Yii::$app->user->id)
        ]);
    }

    /**
     * Deletes an existing Logbook model.
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
     * Finds the Logbook model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Logbook the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Logbook::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
