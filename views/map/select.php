<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Map */
/* @var $answers1 array */
/* @var $answers2 array */
/* @var $cellCodes array */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Maps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerJsVar('cellCodes', array_flip($cellCodes));
$this->registerJsVar('cellUrl', Url::to(['cell/view']));

$js = "$('#map-question1, #map-question2').on('change', function() {
        let q1 = $('#map-question1').val();
        let q2 = $('#map-question2').val();
        let result = '';
        if(q1 && q2) {
            cell = cellCodes[q1+q2] ? cellCodes[q1+q2] : null;
            if(cell) {
                let url = cellUrl + '&id=' + cell;
                result = '<a href='+url+'>'+q1 + q2 + '</a>';
            } else {
                result = 'N/A';
            }
        } else {
            result = 'need answers';
        }
        $('#result').html(result);
    }).change();";
$this->registerJs($js);

?>
<div class="map-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>Answer two key customer questions:</p>
    
    <div class="map-form">

        <?php $form = ActiveForm::begin(); ?>          

        <?= $form->field($model, 'question1')->dropDownList($answers1, ['prompt' => 'Select your answer'])->label($model->question1_text) ?>

        <?= $form->field($model, 'question2')->dropDownList($answers2, ['prompt' => 'Select your answer'])->label($model->question2_text) ?>        
        
        <div class="row">
            Your result:&nbsp;&nbsp;<span id="result">need answers</span>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
