<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cell */
/* @var $code string */

$map = $model->answer1->map;
$this->title = "$code full content";
$this->params['breadcrumbs'][] = ['label' => 'Maps', 'url' => ['map/index']];
$this->params['breadcrumbs'][] = ['label' => $map->name, 'url' => ['map/view', 'id' => $map->id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<h2><?=$map->name ?> - <?=$code ?> full content</h2>
<div>
    <?= Html::button('print', ['class' => 'btn btn-info', 'onClick' => 'javascript:window.print()']) ?>
</div>
<div class="cell-content">
    <?= $model->content ?>    
</div>
