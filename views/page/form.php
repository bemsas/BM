<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use yii\helpers\Url;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Page */
/* @var $form yii\widgets\ActiveForm */

$this->title = $model->isNewRecord ? 'Create Page' : 'Update Page';
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
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
<div class="page-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="page-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'content')->widget(CKeditor::class, [
            'options' => ['rows' => 8],
            'preset' => 'full'
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>

<?php Modal::end();  ?>
