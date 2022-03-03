<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\MapCompany;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MapCompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $companies array */
?>
<div class="map-company-index">    

    <p>
        <?= Html::a('Create Company Access', ['map-company/create', 'mapId' => $searchModel->map_id], ['class' => 'btn btn-info']) ?>
    </p>

    <?php Pjax::begin(); ?>    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => null,
        'layout' => '{items}',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],                        
            [
                'attribute' => 'company_id',
                'value' => function(MapCompany $model) {
                    return $model->company->name;
                },
                'filter' => $companies
            ],
            [
                'header' => 'controls',
                'class' => ActionColumn::class,
                'template' => '{update} {delete}',
                'controller' => 'map-company',                
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
