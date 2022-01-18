<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Map;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MapSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Maps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="map-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Map', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'name',
                'value' => function(Map $model) {
                    return Html::a($model->name, ['view', 'id' => $model->id], ['data-pjax' => 0]);
                },
                'format' => 'raw'
            ],
            'question1_text',
            'question2_text',            
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
