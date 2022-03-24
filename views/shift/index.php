<?php

use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Shift;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ShiftSearch */
/* @var $map app\models\Map */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $cellCodes array */

?>
<div class="shift-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Shift', ['/shift/create', 'mapId' => $map->id], ['class' => 'btn btn-info', 'style' => 'float: right; margin-top: -70px;']) ?>
    </p>

    <?php Pjax::begin(); ?>    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => null,
        'layout' => '{items}',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'cell_start_id',
                'value' => function(Shift $model) use ($cellCodes) {
                    return Html::a($cellCodes[$model->cell_start_id], ['/cell/view', 'id' => $model->cell_start_id], ['data-pjax' => 0]);
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'cell_end_id',
                'value' => function(Shift $model) use ($cellCodes) {
                    return Html::a($cellCodes[$model->cell_end_id], ['/cell/view', 'id' => $model->cell_end_id], ['data-pjax' => 0]);
                },
                'format' => 'raw'
            ],
            [
                'class' => ActionColumn::class,
                'contentOptions' => ['class' => 'action-column'],
                'header' => 'controls',
                'template' => '{update} {delete}',
                'controller' => 'shift'
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
