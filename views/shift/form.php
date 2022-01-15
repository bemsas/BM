<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Shift */
/* @var $map  app\models\Map */
/* @var $form yii\widgets\ActiveForm */
/* @var $cells array */

$this->title = $model->isNewRecord ? 'Create Shift' : 'Update Shift';
$this->params['breadcrumbs'][] = ['label' => 'Maps', 'url' => ['map/index']];
$this->params['breadcrumbs'][] = ['label' => $map->name, 'url' => ['map/view', 'id' => $map->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shift-create">

    <h1><?= Html::encode($this->title) ?></h1>    

    <div class="shift-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'cell_start_id')->dropDownList($cells) ?>

        <?= $form->field($model, 'cell_end_id')->dropDownList($cells) ?>

        <?= $form->field($model, 'question1_content')->textArea(['maxlength' => 2000, 'rows' => 5])->label($map->question1_text) ?>

        <?= $form->field($model, 'question2_content')->textArea(['maxlength' => 2000, 'rows' => 5])->label($map->question2_text) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
