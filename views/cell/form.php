<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\color\ColorInput;

/* @var $this yii\web\View */
/* @var $model app\models\Cell */
/* @var $map \app\models\Map */
/* @var $form yii\widgets\ActiveForm */

/* @var $answers1 array */
/* @var $answers2 array */

$this->title = $model->isNewRecord ? 'Create Cell' : 'Update Cell';
$this->params['breadcrumbs'][] = ['label' => 'Maps', 'url' => ['map/index']];
$this->params['breadcrumbs'][] = ['label' => $map->name, 'url' => ['map/view', 'id' => $map->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cell-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="cell-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'answer1_id')->dropDownList($answers1) ?>

        <?= $form->field($model, 'answer2_id')->dropDownList($answers2) ?>
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
