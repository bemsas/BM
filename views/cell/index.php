<?php

use yii\helpers\Html;
use app\models\Cell;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $map app\models\Map */
/* @var $searchModel app\models\CellSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $cellCodes array */
?>
<div class="cell-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cell', ['/cell/create', 'mapId' => $searchModel->mapId], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => null,
        'layout' => '{items}',
        'columns' => [
            [
                'attribute' => 'id',
                'value' => function(Cell $model) use ($cellCodes) {
                    return Html::a($cellCodes[$model->id], ['/cell/view', 'id' => $model->id]);
                },
                'contentOptions' => function(Cell $model) use ($cellCodes) {
                    $color = $model->getColor($cellCodes[$model->id]);
                    return ['style' => "background: $color"];
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'answer1.content',
                'label' => $map->question1_text,
            ],
            [
                'attribute' => 'answer2.content',
                'label' => $map->question2_text,
            ],
            'question1_compact',
            'question2_compact',
            'links',
            [
                'class' => ActionColumn::class,
                'header' => 'controls',
                'controller' => 'cell',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
