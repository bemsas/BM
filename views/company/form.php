<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\color\ColorInput;

/* @var $this yii\web\View */
/* @var $model app\models\Company */
/* @var $form yii\widgets\ActiveForm */

$this->title = $model->isNewRecord ? 'Create Company' : 'Update Company';
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="company-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'color')->widget(ColorInput::class, [
                'options' => ['placeholder' => 'Select color ...'],
            ])
        ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
