<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Shift */
/* @var $map  app\models\Map */
/* @var $form yii\widgets\ActiveForm */
/* @var $cells array */

$this->title = $model->isNewRecord ? 'Create Shift' : "Update Shift {$cells[$model->cellStart->id]} - {$cells[$model->cellEnd->id]}";
$this->params['breadcrumbs'][] = ['label' => 'Maps', 'url' => ['map/index']];
$this->params['breadcrumbs'][] = ['label' => $map->name, 'url' => ['map/view', 'id' => $map->id]];
$this->params['breadcrumbs'][] = $this->title;

Modal::begin([
    'title' => $this->title,
    'id' => 'modal-container',
    'size' => Modal::SIZE_LARGE,
    'centerVertical' => true,
]);
$this->registerJsVar('returnUrl', Url::to(['map/view', 'id' => $map->id, 'tab' => 'shifts']));
$js = "$(function(){ $('#modal-container').modal('show'); });
    $('#modal-container').on('hide.bs.modal', function(e){location.href = returnUrl});
    ";
$this->registerJs($js);
?>
<div class="shift-create">    

    <div class="shift-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'cell_start_id')->dropDownList($cells) ?>

        <?= $form->field($model, 'cell_end_id')->dropDownList($cells) ?>
        
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-info']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
<?php Modal::end();  ?>