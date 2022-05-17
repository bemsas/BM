<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use yii\helpers\Url;
use kartik\icons\Icon;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Logbook;
use app\models\Cell;

/* @var $this yii\web\View */
/* @var $model app\models\Map */
/* @var $form yii\widgets\ActiveForm */
/* @var $sizes array */
/* @var $cellCodes array */
/* @var $cellIds array */
/* @var $cellCounts array */

$this->title = "Scatter plot";
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['product/list']];
$this->params['breadcrumbs'][] = ['label' => $model->product->name, 'url' => ['product/view', 'id' => $model->product->id]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['map/select', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;

$datesRaw = array_keys(reset($cellCounts));
$dates = [];
foreach($datesRaw as $date) {
    $dates[$date] = $date;
}

$js = "$(function(){        
        $('#select-date').on('change', function(){
            let date = this.value;
            $('.logbook-count').addClass('hidden');
            $('.logbook-count.date-'+date).removeClass('hidden');
        }).change();
    })";
$this->registerJs($js);
?>
<div class="map-report">
    
    <div class="map-form">
        <div class="row">
            <div class="map-preview col-lg-4" style="padding-right: 30px;">
                <h3>customer<br>map</h3>
            <?php
                $rows = array_slice(['A', 'B', 'C', 'D', 'E'], 0, $model->size);
                $columns = array_slice(['5', '4', '3', '2', '1'], 5 - $model->size, $model->size);
                $wide = 7 - $model->size;
                foreach($rows as $row) {
                    echo Html::beginTag('div', ['class' => 'row']);
                    foreach($columns as $column) {
                        $arrows = [];
                        $cellCode = $row.$column;
                        $cellId = isset($cellIds[$cellCode]) ? $cellIds[$cellCode] : null;
                        if(key_exists($cellId, $cellCounts)) {
                            foreach($cellCounts[$cellId] as $date => $count) {
                                if($count > 99) {
                                    $count = "99+";
                                }
                                $arrows[] = Html::tag('div', $count, ['class' => "logbook-count hidden date-$date"]);

                            }
                            //$arrow = Html::tag('div', $count, ['class' => "logbook-count"]);
                        }
                        $arrow = implode("\n", $arrows);
                        $color = $colors[$cellCode];
                        echo Html::tag("div", $cellCode.$arrow, ['class' => "cell", 'style' => "background: $color", 'data-code' => $cellCode]), "\n";
                    }
                    echo Html::endTag('div');
                }
            ?>
                <parent class="vertical">
                    <div class="legend">&nbsp;Payer&nbsp;belief&nbsp;</div>
                    <div class="line">
                        <div class="bullet"></div>
                    </div>
                </parent>
                <parent>
                    <span class="legend">&nbsp;Payer&nbsp;Practice&nbsp;</span>
                    <div class="line">
                        <div class="bullet"></div>
                    </div>
                </parent>
                <div>
                    <h2>Instructions</h2>
                    <p>
                        Patients with the disease had a decreased adjusted HRQoL score of 4.7, reflecting a poorer. European guidelines recommend screening for patients with the disease<br><br>

                        The European guidelines state ‘’ diagnostics tests should be used for initial assessment of a patient with newly diagnosed disease in order to evaluate their suitability for particular therapies’.
                        The limitations of current therapies.
                    </p>
                </div>
            </div>
            <div class="col-lg-8 report-data-container">
                <div style="margin-bottom: 20px;">
                    <?= Html::dropDownList('date', reset($dates), $dates, ['class' => 'form-control', 'id' => 'select-date']); ?>
                </div>
                <?php Pjax::begin(); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => null,
                    'summary' => null,
                    'columns' => [
                        [
                            'attribute' => 'contact_id',
                            'value' => function(Logbook $model) {
                                return $model->contact->name;
                            },
                        ],
                        [
                            'attribute' => 'cell_id',
                            'label' => 'Position',
                            'value' => function(Logbook $model) {
                                $codes = Cell::getCodeList($model->cell->answer1->map_id);
                                return $codes[$model->cell->id];
                            },
                        ],
                        'date_in:datetime',
                    ],
                ]); ?>

                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>