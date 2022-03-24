<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Contact;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $users array */

$this->title = 'Contacts';
$this->params['breadcrumbs'][] = $this->title;
echo Html::a('Create Contact', ['create'], ['class' => 'btn btn-info', 'style' => 'float: right; margin-top: -60px;']);
?>
<div class="contact-index">

    <h1><?= Html::encode($this->title) ?></h1>    

    <?php Pjax::begin(); ?>    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'user_id',
                'value' => function(Contact $model) {
                    return $model->user->name;
                },
                'filter' => $users,
                'visible' => $users ? true : false
            ],
            'name',            
            [
                'header' => 'Controls',
                'class' => ActionColumn::class,
                'contentOptions' => ['class' => 'action-column'],
                'urlCreator' => function ($action, Contact $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
