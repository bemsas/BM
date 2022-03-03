<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $types array */
/* @var $companies array */
/* @var $isAdmin */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
if($isAdmin) {
    echo Html::a('Create User', ['create'], ['class' => 'btn btn-info', 'style' => 'float: right; margin-top: -60px;']);
}
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>    

    <?php Pjax::begin(); ?>    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'email',
                'value' => function(User $model) {
                    return Html::a($model->email, ['view', 'id' => $model->id], ['data-pjax' => 0]);
                },
                'format' => 'raw',
            ],
            'name',
            [
                'attribute' => 'type',
                'value' => function(User $model) use ($types){
                    return $types[$model->type] ?: $model->type;
                },
                'filter' => $types,
            ],
            [
                'attribute' => 'company_id',
                'value' => function(User $model) {
                    return $model->company->name;
                },
                'filter' => $companies,
                'visible' => $isAdmin,
            ],
            [
                'header' => 'Controls',
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                'visible' => $isAdmin
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
