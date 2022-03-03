<?php

 use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Answer */
/* @var $form yii\widgets\ActiveForm */

$questionText = $model->question == 1 ? $model->map->question1_text : $model->map->question2_text;
$this->title = $model->isNewRecord ? "Create $questionText answer" : "Update $questionText answer";

$this->params['breadcrumbs'][] = ['label' => 'Maps', 'url' => ['map/index']];
$this->params['breadcrumbs'][] = ['label' => $model->map->name, 'url' => ['map/view', 'id' => $model->map->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="answer-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="answer-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'content')->textArea(['maxlength' => 200, 'rows' => 6]) ?>    

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-info']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
