<?php

use yii\helpers\Html;
use kartik\color\ColorInput;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use yii\helpers\Url;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Company */
/* @var $form yii\widgets\ActiveForm */

$this->title = $model->isNewRecord ? 'Create Company' : 'Update Company';
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

Modal::begin([
    'title' => $this->title,
    'id' => 'modal-container',
    'size' => Modal::SIZE_LARGE,
    'centerVertical' => true,
]);
$this->registerJsVar('returnUrl', Url::to(['index']));
$js = "$(function(){ $('#modal-container').modal('show'); });
    $('#modal-container').on('hide.bs.modal', function(e){location.href = returnUrl});
    ";
$this->registerJs($js);
?>
<div class="company-create">    

    <div class="company-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>        
        
        <?= $form->field($model, 'color')->widget(ColorInput::class, [
                'options' => ['placeholder' => 'Select color ...'],
            ])
        ?>
        
        <?= $form->field($model, 'color_text')->widget(ColorInput::class, [
                'options' => ['placeholder' => 'Select text color ...'],
            ])
        ?>
        
        <?= $form->field($model, 'icon')->textInput(['maxlength' => 2000]) ?>

        <?= $form->field($model, 'hello_left')->widget(CKeditor::class, [
            'options' => ['rows' => 8],
            'preset' => 'full'
        ]) ?>

        <?= $form->field($model, 'hello_right')->widget(CKeditor::class, [
            'options' => ['rows' => 8],
            'preset' => 'full'
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-info']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
<?php Modal::end();  ?>