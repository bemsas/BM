<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Logbook */
/* @var $form yii\widgets\ActiveForm */
/* @var $contacts array */

$this->title = $model->isNewRecord ? 'Create Logbook' : 'Update logbook';
$this->params['breadcrumbs'][] = ['label' => 'Logbooks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logbook-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="logbook-form">

        <?php $form = ActiveForm::begin(); ?>        

        <?= $form->field($model, 'contact_id')->dropDownList($contacts) ?>        

        <?= $form->field($model, 'content')->textArea(['maxlength' => 2000]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
