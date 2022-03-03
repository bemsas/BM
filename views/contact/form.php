<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contact */
/* @var $form yii\widgets\ActiveForm */

$this->title = $model->isNewRecord ? 'Create Contact' : 'Update Contact';
$this->params['breadcrumbs'][] = ['label' => 'Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-create">

    <h1><?= Html::encode($this->title) ?></h1>    

    <div class="contact-form">

        <?php $form = ActiveForm::begin(); ?>        
        
        <?= $form->field($model, 'name')->textInput(['maxlength' => 200]) ?>        

        <?= $form->field($model, 'comment')->textArea(['maxlength' => 2000]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-info']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
