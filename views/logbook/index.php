<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Logbook;
/* @var $this yii\web\View */
/* @var $searchModel app\models\LogbookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $contacts array */

$this->title = 'Logbooks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logbook-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Logbook', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'user_id',
                'value' => function(Logbook $model) {
                    return $model->user->name;
                },
                'filter' => false
            ],
            [
                'attribute' => 'contact_id',
                'value' => function(Logbook $model) {
                    return $model->contact->name;
                },
                'filter' => $contacts
            ],
            'date_in:datetime',
            'content:ntext',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Logbook $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
