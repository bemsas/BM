<?php

use yii\helpers\Html;
use app\models\Cell;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CellSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $answerPositions1 array */
/* @var $answerPositions2 array */
?>
<div class="cell-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cell', ['/cell/create', 'mapId' => $searchModel->mapId], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'value' => function(Cell $model) use ($answerPositions1, $answerPositions2) {
                    return $answerPositions1[$model->answer1_id].$answerPositions2[$model->answer2_id];
                }
            ],
            'answer1.content',
            'answer2.content',
            [
                'class' => ActionColumn::class,
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
