<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Company;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
echo Html::a('Create Company', ['create'], ['class' => 'btn btn-info', 'style' => 'float: right; margin-top: -60px;']);
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>    

    <?php Pjax::begin(); ?>    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name:text:Company Name',
            [
                'attribute' => 'name',                
                'label' => 'Brand colours',
                'contentOptions' => function(Company $model) {
                    $color = $model->getColor();                    
                    return ['style' => "background: $color; color: {$model->color_text}"];
                },
            ],
            [
                'attribute' => 'icon',
                'label' => 'Logo',
                'value' => function(Company $model) {
                    if($model->icon) {
                        return Html::img($model->icon, ['title' => 'company icon', 'style' => 'width:64px;']);
                    } else {
                        return 'empty';
                    }
                },
                'format' => 'raw'  
            ],
            [
                'header' => 'Controls',
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Company $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
