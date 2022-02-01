<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Logbook;

/* @var $this yii\web\View */
/* @var $model app\models\Logbook */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Logbooks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="logbook-view">

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'user_id',
                'value' => function(Logbook $model) {
                    return $model->user->name;
                },                
            ],
            [
                'attribute' => 'contact_id',
                'value' => function(Logbook $model) {
                    return $model->contact->name;
                },                
            ],
            'date_in:datetime',
            'content:ntext',
        ],
    ]) ?>

</div>
