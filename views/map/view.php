<?php

use yii\helpers\Html;
use yii\bootstrap4\Tabs;

/* @var $this yii\web\View */
/* @var $model app\models\Map */
/* @var $companyIndex string */
/* @var $answer1Index string */
/* @var $answer2Index string */
/* @var $cellIndex string */
/* @var $shiftIndex string */
/* @var $tab string */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Maps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="map-view">    

    <p style="text-align: right; margin-top: -50px;">
        <?= Html::a('Select', ['select', 'id' => $model->id], ['class' => 'btn btn-info', ]) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>    

</div>

<?php
    echo Tabs::widget([
        'items' => [
            [
                'label' => 'Access',
                'content' => $companyIndex,
                'active' => $tab == 'access',
            ],
            [
                'label' => $model->question1_text,
                'content' => $answer1Index,
                'active' => $tab == 'question1',
            ],
            [
                'label' => $model->question2_text,
                'content' => $answer2Index,
                'active' => $tab == 'question2',
            ],
            [
                'label' => 'Cells',
                'content' => $cellIndex,
                'active' => $tab == 'cells',
            ],
            [
                'label' => 'Shifts',
                'content' => $shiftIndex,
                'active' => $tab == 'shifts',
            ],
        ],
    ]);
?>
