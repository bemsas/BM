<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MapCompany */
/* @var $form yii\widgets\ActiveForm */    
/* @var $companies array */

$this->title = $model->isNewRecord ?  'Create Company Access' : 'Update Company Access';
$this->params['breadcrumbs'][] = ['label' => 'Maps', 'url' => ['map/index']];
$this->params['breadcrumbs'][] = ['label' => $model->map->name, 'url' => ['map/view', 'id' => $model->map_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="map-company-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="map-company-form">

        <?php $form = ActiveForm::begin(); ?>        

        <?= $form->field($model, 'company_id')->dropDownList($companies) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
