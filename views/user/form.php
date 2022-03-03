<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
/* @var $types array */
/* @var $companies array */

$this->title = $model->isNewRecord ? 'Create User' : 'Update User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => 200]) ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => 200]) ?>

        <?= $form->field($model, 'password')->passwordInput(['maxlength' => 200]) ?>

        <?= $form->field($model, 'type')->dropDownList($types) ?>

        <?= $form->field($model, 'company_id')->dropDownList($companies) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-info']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
