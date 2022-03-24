<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Map */
/* @var $form yii\widgets\ActiveForm */
/* @var $sizes array */

$this->title = $model->isNewRecord ? 'Create Map' : 'Update Map';
$this->params['breadcrumbs'][] = ['label' => 'Maps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

Modal::begin([
    'title' => $this->title,
    'id' => 'modal-container',
    'size' => Modal::SIZE_LARGE,
    'centerVertical' => true,
]);
$this->registerJsVar('returnUrl', Url::to($model->isNewRecord ? ['index'] : ['view', 'id' => $model->id]));
$js = "$(function(){ $('#modal-container').modal('show'); });
    $('#modal-container').on('hide.bs.modal', function(e){location.href = returnUrl});
    ";
$this->registerJs($js);
?>
<div class="map-create">    

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
<?php Modal::end();  ?>