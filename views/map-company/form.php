<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\MapCompany */
/* @var $form yii\widgets\ActiveForm */    
/* @var $companies array */

$this->title = $model->isNewRecord ?  'Create Company Access' : 'Update Company Access';
$this->params['breadcrumbs'][] = ['label' => 'Maps', 'url' => ['map/index']];
$this->params['breadcrumbs'][] = ['label' => $model->map->name, 'url' => ['map/view', 'id' => $model->map_id]];
$this->params['breadcrumbs'][] = $this->title;

Modal::begin([
    'title' => $this->title,
    'id' => 'modal-container',
    'size' => Modal::SIZE_LARGE,
    'centerVertical' => true,    
]);
$this->registerJsVar('returnUrl', Url::to(['map/view', 'id' => $model->map_id, 'tab' => 'access']));
$js = "$(function(){ $('#modal-container').modal('show'); });
    $('#modal-container').on('hide.bs.modal', function(e){location.href = returnUrl});
    ";
$this->registerJs($js);
?>

<div class="map-company-create">    

    <div class="map-company-form">

        <?php $form = ActiveForm::begin(); ?>        

        <?= $form->field($model, 'company_id')->dropDownList($companies) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-info']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
<?php Modal::end();  ?>
