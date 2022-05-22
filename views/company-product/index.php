<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\CompanyProduct;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanyProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* $var $products array */

$this->title = 'Company Products';
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['company/index']];
$this->params['breadcrumbs'][] = $this->title;
echo Html::a('Create access', ['create', 'companyId' => $searchModel->company_id], ['class' => 'btn btn-info', 'style' => 'float: right; margin-top: -60px;']);
?>
<div class="company-product-index">

    <h1><?= Html::encode($this->title) ?></h1>    

    <?php Pjax::begin(); ?>    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'product_id',
                'value' => function(CompanyProduct $model) {
                    return $model->product->name;
                },
                'filter' => $products,
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{delete}',
                'urlCreator' => function ($action, CompanyProduct $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
