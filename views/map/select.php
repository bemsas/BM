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

$cellCodes = array_flip($cellCodes);
$this->registerJsVar('cellCodes', $cellCodes);
$this->registerJsVar('cellUrl', Url::to(['cell/view']));

$js = "$('#map-question1, #map-question2').on('change', function() {
        $('.cell-selected').removeClass('cell-selected');
        let q1 = $('#map-question1').val();
        let q2 = $('#map-question2').val();
        let result = '';
        if(q1 && q2) {
            cell = cellCodes[q1+q2] ? cellCodes[q1+q2] : null;
            if(cell) {
                let url = cellUrl + '&id=' + cell;
                result = '<a href='+url+'>'+q1 + q2 + '</a>';                
                $('#cell-'+q1+q2).addClass('cell-selected');
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
        <p>&nbsp;</p>
        <div class="map" style="width: 60%; margin:auto;">            
            <?php
                $rows = array_slice(['A', 'B', 'C', 'D', 'E'], 0, $model->size);
                $columns = array_slice(['5', '4', '3', '2', '1'], 5 - $model->size, $model->size);
                $wide = 7 - $model->size;
                foreach($rows as $row) {
                    echo Html::beginTag('div', ['class' => 'row']);
                    foreach($columns as $column) {
                        $value = isset($cellCodes[$row.$column]) ? Html::a($row.$column, ['cell/view', 'id' => $cellCodes[$row.$column]]) : '&nbsp;';
                        echo Html::tag("div", $value, ['class' => "col-lg-$wide cell bg-{$row}{$column}", 'id' => "cell-$row$column"]), "\n";
                    }
                    echo Html::endTag('div');
                }                                
            ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
