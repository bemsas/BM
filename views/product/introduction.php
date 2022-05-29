<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'Introduction and Guidance';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['list']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-resource">
    <div class="product-view__container">

        <h1><?= Html::encode($this->title) ?></h1>
    
        <div class="product-view__text"><?=$model->introduction?></div>

    </div>    
</div>
