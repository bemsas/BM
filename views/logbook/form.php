<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Logbook */
/* @var $form yii\widgets\ActiveForm */
/* @var $contacts array */

if(get_class($this->context) == \app\controllers\LogbookController::class) {    
    $this->title = $model->isNewRecord ? 'Add Logbook' : 'Update logbook';
    $this->params['breadcrumbs'][] = ['label' => 'Logbooks', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
}    

$url = $model->isNewRecord ? Url::to(['logbook/create']) : Url::to(['logbook/update', 'id' => $model->id]);
?>
<div class="logbook-create">

    <?php
        if(get_class($this->context) == \app\controllers\LogbookController::class) { ?>
            <h1><?= Html::encode($this->title) ?></h1>
        <?php } ?>    
    
    <div class="logbook-form">

        <?php $form = ActiveForm::begin(['action' => $url]); ?>        

        <?= $form->field($model, 'content')->textArea(['maxlength' => 2000])->label(false) ?>
        
        <?= $form->field($model, 'fromCell')->hiddenInput()->label(false); ?>
        
        <?= $form->field($model, 'cell_id')->hiddenInput()->label(false); ?>
        
        <?= $form->field($model, 'contact_id')->hiddenInput()->label(false); ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
