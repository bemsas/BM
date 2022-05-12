<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Map */
/* @var $form yii\widgets\ActiveForm */
/* @var $sizes array */

$this->title = "Scatter plot";
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['product/list']];
$this->params['breadcrumbs'][] = ['label' => $model->product->name, 'url' => ['product/view', 'id' => $model->product->id]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['map/select', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="map-report">

    <h1><?=$this->title?></h1>

    <p class="text-danger" style="font-size: 18pt">Scatter plot under developing!</p>

</div>