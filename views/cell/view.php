<?php

use yii\helpers\Html;
use kartik\slider\Slider;
use yii\bootstrap4\Modal;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model app\models\Cell */
/* @var $cellCodes array */
/* @var $code string */
/* @var $colors array*/
/* @var $color string */
/* @var $shifts \app\models\Shift[] */
/* @var $contact \app\models\Contact */
/* @var $logbookForm string */

$map = $model->answer1->map;
$this->title = $code;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['product/list']];
$this->params['breadcrumbs'][] = ['label' => $map->product->name, 'url' => ['product/view', 'id' => $map->product->id]];
$this->params['breadcrumbs'][] = $this->title;

$shiftCells = [];
$barColors = [];
$cellButtons = [];
$sliderValue = 1;
if($shifts) {
    $shiftCells[] = $shifts[0]->cellStart;
    $cellCode = $cellCodes[$shifts[0]->cellStart->id];
    $barColors[] = $colors[$cellCode];
    $cellButtons[] = Html::tag('div', $cellCode, ['class' => 'cell-button', 'data-num' => 1]);
    foreach($shifts as $i => $shift) {
        $shiftCells[] = $shift->cellEnd;
        $cellCode = $cellCodes[$shift->cellEnd->id];
        if($cellCode == $code) {
            $sliderValue = $i + 2;
        }
        $barColors[] = $colors[$cellCode]; 
        $cellButtons[] = Html::tag('div', $cellCode, ['class' => 'cell-button', 'data-num' => $i + 2]);
    }    
}


$js = '$(function(){$(".cell-button").on("click", function(){
        $(".selected").removeClass("selected");
        $(".previos").removeClass("previos");
        let num = $(this).data("num");
        $(".full-content-container").addClass("hidden");
        $(".full-content-container[data-num="+num+"]").removeClass("hidden");
        let code=$(this).data("code");
        $(this).addClass("selected");
        $(".cell[data-cell="+code+"]").addClass("selected");
        $(".shift-block.q1:lt("+(num - 1)+")").addClass("previos");
        $(".shift-block.q2:lt("+(num - 1)+")").addClass("previos");
        $(".shift-block[data-code="+code+"]").addClass("selected");
    }); $(".cell-button[data-code='.$code.']").click();});';
$this->registerJs($js);

$shiftBlockWidth = 185 * 4 / $map->size;
$axisWidth = 65 * $map->size;
?>
<style>
    /* .shift-block {
        width: <?=$shiftBlockWidth?>px;
    } */
    /* parent {     
          width: <?= $axisWidth?>px
    } */

</style>
<div class="cell-view">  
    <div class="cell-view__content">
        <div class="row">
            <div class="col-lg-3" style="align-items: center;">
                <div class="map-preview">
                    <h4 class="map-preview__title">Customer<br>position map</h4>
                    <div class="map-preview__inner">
                        <?php 
                            if($code == 'A1') {
                                echo Html::tag("div", "No approach shifts required for A1 profile payers", ['class' => "answer-block"]), "\n";
                            } else {                    
                                $rows = array_slice(['A', 'B', 'C', 'D', 'E'], 0, $map->size);
                                $columns = array_slice(['5', '4', '3', '2', '1'], 5 - $map->size, $map->size);
                                $wide = 7 - $map->size;
                                foreach($rows as $i => $row) {
                                    echo Html::beginTag('div', ['class' => 'row']);
                                    foreach($columns as $j => $column) {
                                        $arrow = '';
                                        $cellCode = $row.$column;
                                        $cellClass = "cell";
                                        foreach($shifts as $i => $shift) {
                                            if($cellCodes[$shift->cell_start_id] == $cellCode) {
                                                $cellClass = "cell cell-with-arrow";
                                                $endCell = $cellCodes[$shift->cell_end_id];
                                                if($endCell[0] == $row) {
                                                    $vectorClass = 'arrow-right';
                                                } elseif($endCell[1] == $column) {
                                                    $vectorClass = 'arrow-top';
                                                } else {
                                                    $vectorClass = 'arrow-right-top';
                                                }
                                                $num = $i + 1;
                                                $arrow = Html::tag('div', Icon::show('arrow-right')."<br>".$num, ['class' => "arrow-select $vectorClass"]);
                                            }
                                            if($cellCodes[$shift->cell_end_id] == $cellCode) {
                                                $cellClass = "cell cell-with-arrow";
                                            }
                                        }                            
                                        $color = $colors[$cellCode];
                                        if($cellClass == 'cell') {
                                            $cellCode = '';
                                        }
                                        echo Html::tag("div", $cellCode. $arrow, ['class' => $cellClass, 'style' => "background: $color", 'data-cell' => $cellCode ]), "\n";
                                    }
                                    echo Html::endTag('div');                        
                                }
                                ?>       
                                <parent class="vertical">
                                    <span class="legend">&nbsp;Payer&nbsp;belief&nbsp;</span>
                                    <div class="line">
                                        <div class="bullet"></div>
                                    </div>
                                </parent>
                                <parent class="horizontal">
                                    <span class="legend">&nbsp;Payer&nbsp;Practice&nbsp;</span>
                                    <div class="line">
                                        <div class="bullet"></div>
                                    </div>                                                
                                </parent>                    
                            <?php }
                        ?>       
                    </div>    
                </div>
            </div>
            <?php if($code == 'A1') { ?>
            <div class="col-lg-9">
                <div class="answer-block">You have successfully achieved your payer ideal approach/funding goal! No further shifts are required.</div>
            </div>
            <?php } else { ?>        
            <div class="col-lg-9">
                <div class="shift-block-container">
                    <div class="shift-title"> Belief</div>       
                    <div class="shift-block-grid">       
                        <?php
                            $count = count($shiftCells);
                            foreach($shiftCells as $i => $shiftCell) {
                                    $cellCode = $cellCodes[$shiftCell->id];
                                    $cellColor = $colors[$cellCode];
                                ?>
                                <div
                                    class="shift-block q1"
                                    data-num="<?=$i+1 ?>"
                                    data-code ="<?=$cellCode ?>"
                                    data-color="<?=$cellColor?>"
                                >
                                    <?=$shiftCell->question1_compact ?>
                                </div>
                            <?php }
                        ?>         
                    </div>         
                </div>
                <div class="row steps-row">
                    <?php
                        $count = count($shiftCells);
                        foreach($shiftCells as $i => $shiftCell) {
                                $cellCode = $cellCodes[$shiftCell->id];
                                $cellColor = $colors[$cellCode];
                            ?>
                            <div
                                class="cell-button"
                                data-num="<?=$i+1 ?>"
                                data-code ="<?=$cellCode ?>"
                            >
                                <?=$cellCode?>
                            </div>
                        <?php
                            if($i < $count - 1) {
                                ?>
                                <div class="arrow-between">
                                    <?= Icon::show('arrow-right') ?><br>Shift <?=$i+1 ?>
                                </div>
                            <?php }
                        }
                    ?>                
                </div>
                <div class="shift-block-container">
                    <div class="shift-title second"> Practice</div>
                    <div class="shift-block-grid"> 
                        <?php
                            foreach($shiftCells as $i => $shiftCell) { 
                                    $cellCode = $cellCodes[$shiftCell->id];
                                    $cellColor = $colors[$cellCode];                            
                                ?>                        
                                <div 
                                    class="shift-block q2" 
                                    data-num="<?=$i+1 ?>" 
                                    data-code ="<?=$cellCode ?>" 
                                    data-color="<?=$cellColor?>"
                                >                             
                                    <?=$shiftCell->question2_compact ?>                            
                                </div>
                            <?php }
                        ?>
                    </div>  
                </div>            
            </div> 
        </div>  
    </div>
    <div class="cell-view__footer">
        <?php 
            foreach($shiftCells as $i => $shiftCell) {
                    $num = $i +1;
                    $links = '';
                    $dis2 = $shiftCell->link_full_deck ? '' : 'disabled';
                    $dis3 = $shiftCell->link_pdf ? '' : 'disabled';
                    if($shiftCell->links) {
                        $urls = explode(' ', $shiftCell->links);
                        $links = [];
                        foreach($urls as $j => $url) {                        
                            $linkNum = $j + 1;
                            $links[] = Html::a('link '.$linkNum, $url);
                        }
                        $links = Html::tag('div', implode(', ', $links));                    
                    }
                    ?>                
                    <div class="full-content-container hidden" data-num="<?=$num?>">
                        <div class="shift-content">
                            <?=$shiftCell->content.$links?>
                        </div>
                        <h3>Shift <?=$num ?> Messaging :</h3>
                        <h4>Learn more :</h4>
                        <div class="shift-content-actions">
                            <?= Html::a("Presentation", $shiftCell->link_full_deck, ['class' => "btn content-btn-1 $dis2", 'target' => '_blank']) ?>
                            <?= Html::a("Message Summary", $shiftCell->link_pdf, ['class' => "btn content-btn-2 $dis3", 'target' => '_blank',]); ?>
                        </div>
                    </div>                
            <?php }
        } ?> 
    </div>
</div>
<p>
    &nbsp;
</p>
