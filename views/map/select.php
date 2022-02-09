<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;

/* @var $this yii\web\View */
/* @var $model app\models\Map */
/* @var $answers1 array */
/* @var $answers2 array */
/* @var $cellCodes array */
/* @var $contacts array */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Maps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$cellCodes = array_flip($cellCodes);
$this->registerJsVar('cellCodes', $cellCodes);

$js = "$('#map-question1, #map-question2, #map-contactname').on('change', function() {        
        let q1 = $('#map-question1').val();
        let q2 = $('#map-question2').val();
        let contact = $('#map-contactname').val();
        let result = '';
        if(q1 && q2) {
            cell = cellCodes[q1+q2] ? cellCodes[q1+q2] : null;
            if(cell) {                
                result = 'submit to '+ q1 + q2;
                $('#btn-submit').prop('disabled', contact ? false : true);
            } else {
                result = 'N/A';
                $('#btn-submit').prop('disabled', true);
            }
        } else {
            result = 'need answers';
            $('#btn-submit').prop('disabled', true);
        }
        $('#btn-submit').text(result);
    }).change();";
$this->registerJs($js);
?>
<div class="map-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p><?=$model->intro ?></p>
    
    <div class="map-form">

        <?php $form = ActiveForm::begin(); ?>
        
        <?= $form->field($model, 'contactName')->widget(AutoComplete::class, [
            'options' => [
                'class' => 'form-control',
            ],            
            'clientOptions' => [
                'source' => $contacts,                
            ],
        ]) ?>

        <?= $form->field($model, 'question1')->dropDownList($answers1, ['prompt' => 'Select your answer'])->label($model->question1_text) ?>

        <?= $form->field($model, 'question2')->dropDownList($answers2, ['prompt' => 'Select your answer'])->label($model->question2_text) ?>               
        
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-success', 'id' => 'btn-submit', 'disabled' => true]) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
