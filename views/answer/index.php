<?php

use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AnswerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="answer-index">    

    <p>
        <?= Html::a('Create Answer', ['/answer/create', 'mapId' => $searchModel->map_id, 'question' => $searchModel->question], ['class' => 'btn btn-info', 'style' => 'float: right; margin-top: -70px;']) ?>
    </p>

    <?php Pjax::begin(); ?>    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => null,
        'layout' => '{items}',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'content',            
            [
                'class' => ActionColumn::class,
                'contentOptions' => ['class' => 'action-column'],
                'controller' => 'answer',
                'header' => 'Controls',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
