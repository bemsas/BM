<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Answer */
/* @var $form yii\widgets\ActiveForm */

$questionText = $model->question == 1 ? $model->map->question1_text : $model->map->question2_text;
$this->title = $model->isNewRecord ? "Create $questionText answer" : "Update $questionText answer";

$this->params['breadcrumbs'][] = ['label' => 'Maps', 'url' => ['map/index']];
$this->params['breadcrumbs'][] = ['label' => $model->map->name, 'url' => ['map/view', 'id' => $model->map->id]];
$this->params['breadcrumbs'][] = $this->title;

Modal::begin([
    'title' => $this->title,
    'id' => 'modal-container',
    'size' => Modal::SIZE_LARGE,
    'centerVertical' => true,
]);
$this->registerJsVar('returnUrl', Url::to(['map/view', 'id' => $model->map_id, 'tab' => 'question'.$model->question]));
$js = "$(function(){ $('#modal-container').modal('show'); });
    $('#modal-container').on('hide.bs.modal', function(e){location.href = returnUrl});
    ";
$this->registerJs($js);
?>
<div class="answer-create">    
    
    <div class="answer-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'content')->textArea(['maxlength' => 200, 'rows' => 6]) ?>    

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-info']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
<?php Modal::end();  ?>