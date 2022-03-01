<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Logbook;
use app\models\Cell;
/* @var $this yii\web\View */
/* @var $searchModel app\models\LogbookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $users array */
/* @var $contacts array */

$this->title = 'Logbooks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logbook-index">

    <h1><?= Html::encode($this->title) ?></h1>    

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'user_id',
                'value' => function(Logbook $model) {
                    return $model->user->name;
                },
                'filter' => $users
            ],
            [
                'attribute' => 'contact_id',
                'value' => function(Logbook $model) {
                    return $model->contact->name;
                },
                'filter' => $contacts
            ],
            [
                'attribute' => 'cell_id',
                'label' => 'Map',
                'value' => function(Logbook $model) {
                    return $model->cell->answer1->map->name;
                },
                'filter' => false
            ],
            [
                'attribute' => 'cell_id',
                'label' => 'Position',
                'value' => function(Logbook $model) {
                    $codes = Cell::getCodeList($model->cell->answer1->map_id);
                    return $codes[$model->cell->id];
                },
                'filter' => false
            ],
            'date_in:datetime',
            'content:ntext',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Logbook $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                'contentOptions' => ['style' => 'width: 85px;'],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
