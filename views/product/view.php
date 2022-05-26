<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">
    <div class="product-view__container">

        <h1><?= Html::encode($this->title) ?></h1>
    
        <div class="product-view__text"><?=$model->full?></div>    

    </div>

    <div class="product-view-links">
        <div class="product-view-links__grid">
            <div class="product-view-links__col">
                <?= Html::a('Customer Belief<br>Mapping Tool', ['map/select', 'id' => $model->map_id], ['class' => 'view-card']) ?>
            </div>
            <div class="product-view-links__col">
            <?= Html::a('Customer Position<br>Map and Logbook', ['map/report', 'id' => $model->map_id], ['class' => 'view-card']) ?>
            </div>
            <div class="product-view-links__col">
            <?php
                if($model->add_link) {
                    $url = $model->add_link;
                    $class = 'view-card';
                } else {
                    $url = null;
                    $class = 'view-card disable';
                }
                echo Html::a('Additional<br>Resources', $url, ['class' => $class]);
            ?>
            </div>
        </div>
    </div>
</div>
