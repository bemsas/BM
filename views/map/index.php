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
/* @var $sizes array */
/* @var $isAdmin bool */

$this->title = 'Belief maps';
$this->params['breadcrumbs'][] = $this->title;
if($isAdmin) {        
    echo Html::a('Create Map', ['create'], ['class' => 'btn btn-info', 'style' => 'float: right; margin-top: -60px;']);
}
?>
<div class="map-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => null,
        'layout' => '{items}',
        'columns' => [
            [
                'attribute' => 'id',                
                'contentOptions' => ['style' => 'width: 70px;'],
                'visible' => $isAdmin,
            ],
            [
                'attribute' => 'name',
                'label' => $isAdmin ? 'Name' : '',
                'value' => function(Map $model) use ($isAdmin) {
                    return Html::a($model->name, [$isAdmin ? 'view' : 'select', 'id' => $model->id], ['data-pjax' => 0]);
                },
                'format' => 'raw',                
            ],
            [
                'attribute' => 'size',
                'value' => function(Map $model) use ($sizes){
                    return $sizes[$model->size] ?: $model->size; 
                },
                'filter' => $sizes,
                'visible' => $isAdmin,
            ],
            [
                'attribute' => 'question1_text',
                'visible' => $isAdmin,
            ],
            [
                'attribute' => 'question2_text',
                'visible' => $isAdmin,
            ],            
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
