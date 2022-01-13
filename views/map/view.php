<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Map */
/* @var $answer1Index string */
/* @var $answer2Index string */
/* @var $cellIndex string */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Maps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="map-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
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

<h2><?= Html::encode($model->question1_text) ?></h2>
<?= $answer1Index ?>

<h2><?= Html::encode($model->question2_text) ?></h2>
<?= $answer2Index ?>

<h2>Cells</h2>
<?= $cellIndex ?>
