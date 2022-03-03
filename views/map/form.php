<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Map */
/* @var $form yii\widgets\ActiveForm */
/* @var $sizes array */

$this->title = $model->isNewRecord ? 'Create Map' : 'Update Map';
$this->params['breadcrumbs'][] = ['label' => 'Maps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="map-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="map-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => 200]) ?>
        
        <?= $form->field($model, 'intro')->textArea(['maxlength' => 2000]) ?>
        
        <?= $form->field($model, 'size')->dropDownList($sizes) ?>

        <?= $form->field($model, 'question1_text')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'question2_text')->textInput(['maxlength' => true]) ?>        

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-info']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
