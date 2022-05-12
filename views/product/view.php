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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Patients with the disease had a decreased adjusted HRQoL score of 4.7, reflecting a poorer. European guidelines recommend screening for patients with the disease<br>
        <br>
        The European guidelines state ‘’ diagnostics tests should be used for initial assessment of a patient with newly diagnosed disease in order to evaluate their suitability for particular therapies’.
        The limitations of current therapies.
    </p>    

</div>
<div class="product-view-links">
    <?= Html::a('Customer Belief<br>Mapping Tool', ['map/select', 'id' => $model->map_id]) ?>
    <?= Html::a('Customer Position<br>Map and Logbook', ['map/report', 'id' => $model->map_id]) ?>
    <?php
        if($model->add_link) {
            $url = $model->add_link;
            $class = '';
        } else {
            $url = null;
            $class = 'disable';
        }
        echo Html::a('Additional<br>Resources', $url, ['class' => $class]);
    ?>
</div>
