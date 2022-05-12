<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use yii\helpers\Url;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
/* @var $maps array */

$this->title = $model->isNewRecord ? 'Create Product' : "Update $model->name";
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
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
<div class="product-create">    

    <div class="product-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => 200]) ?>

        <?= $form->field($model, 'description')->widget(CKeditor::class, [
            'options' => ['rows' => 8],
            'preset' => 'full'
        ]) ?>

        <?= $form->field($model, 'map_id')->dropDownList($maps) ?>

        <?= $form->field($model, 'add_link')->textInput(['maxlength' => 200]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
<?php Modal::end();  ?>