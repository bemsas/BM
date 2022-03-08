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
$this->params['breadcrumbs'][] = ['label' => 'Maps', 'url' => ['map/index']];
$this->params['breadcrumbs'][] = ['label' => $map->name, 'url' => ['map/view', 'id' => $map->id]];
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


$js = '$(function(){$("#shift").trigger("slideStop");});';
$this->registerJs($js);

$shiftBlockHeight = $map->size * 76.5 / 2 -5;
$shiftBlockWidth = 132 * 5 / $map->size;
?>
<style>
    .shift-title, .shift-block {
        height: <?=$shiftBlockHeight?>px;
    }
    .shift-block {
        width: <?=$shiftBlockWidth?>px;
    }
</style>
<div class="cell-view">
        
    <div class="row">
        <div class="col-lg-4" style="align-items: center;">
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
                            foreach($shifts as $i => $shift) {
                                if($cellCodes[$shift->cell_start_id] == $cellCode) {
                                    $endCell = $cellCodes[$shift->cell_end_id];
                                    if($endCell[0] == $row) {
                                        $vectorClass = 'arrow-right';
                                    } elseif($endCell[1] == $column) {
                                        $vectorClass = 'arrow-top';
                                    } else {
                                        $vectorClass = 'arrow-right-top';
                                    }
                                    $num = $i + 1;
                                    $arrow = Html::tag('div', Icon::show('arrow-right')."<span>Shift $num</span>", ['class' => "arrow $vectorClass"]);
                                }
                            }                            
                            $color = $colors[$cellCode];
                            echo Html::tag("div", $cellCode. $arrow, ['class' => "cell", 'style' => "background: conic-gradient(from 45deg, $color, {$color}80)" ]), "\n";
                        }
                        echo Html::endTag('div');
                    }
                }
            ?>            
        </div>
        <?php if($code == 'A1') { ?>
        <div class="col-lg-8">
            <div class="answer-block">You have successfully achieved your payer ideal approach/funding goal! No further shifts are required.</div>
        </div>
        <?php } else { ?>        
        <div class="col-lg-8">
            <div class="row">
                <div class="shift-title"> Belief</div>
                <?php
                    $count = count($shiftCells);
                    foreach($shiftCells as $i => $shiftCell) { 
                            $cellCode = $cellCodes[$shiftCell->id];
                            $cellColor = $colors[$cellCode];                             
                        ?>                        
                        <div 
                            style="background: conic-gradient(from 45deg, <?=$cellColor?>, <?=$cellColor?>80)" 
                            class="shift-block q1" 
                            data-num="<?=$i+1 ?>" 
                            data-code ="<?=$cellCode ?>" 
                            data-color="<?=$cellColor?>"
                        >   
                            <?=$shiftCell->question1_compact ?>                            
                            <?php if($i < $count - 1) { ?>
                            <div class="arrow-between">
                                Shift <?=$i+1 ?> <?= Icon::show('arrow-right') ?>
                            </div>                            
                            <?php } ?>                            
                        </div>                        
                    <?php }
                ?>                
            </div>
            <div class="row" style="margin-top: 5px">
                <div class="shift-title"> Funding</div>
                <?php
                    foreach($shiftCells as $i => $shiftCell) { 
                            $cellCode = $cellCodes[$shiftCell->id];
                            $cellColor = $colors[$cellCode];                            
                        ?>                        
                        <div 
                            style="background: conic-gradient(from 45deg, <?=$cellColor?>, <?=$cellColor?>80)" 
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
        <div id="shift-arrow-container">
            <?php 
                $count = count($shifts);
                foreach($shifts as $i => $shift) {
                    $num = $i + 1;
                    $img = Icon::show('arrow-right');
                    echo Html::tag('div', "Shift $num<br>$img", ['class' => 'shift-arrow']);
                }
            ?>
        </div>
        <div id="shift-slider-container" style="background-image: linear-gradient(90deg, <?= implode(', ',$barColors) ?>)">
            <?= Slider::widget([
                'name'=>'rating_1',
                'id' => 'shift',
                'value'=> $sliderValue,
                'pluginOptions'=>[
                    'handle'=>'square',
                    'tooltip'=>'always',
                    'min' => 1,
                    'max' => $map->size,
                    'step' => 1,                
                ],
                'pluginEvents' => [
                    "enabled" => "function(event) { console.log(1111); }",
                    "slideStop" => "function(event) {                    
                        let num = event.value;
                        if(!num) {
                            num = $('#shift').val();
                        }                    

                        $('.shift-block').each(function(index, element) {
                            let color = $(element).data('color');
                            $(element).css('background', 'conic-gradient(from 45deg, '+ color + ', ' + color + '80)');
                        });
                        $('.shift-block.q1:lt('+(num - 1)+')').css('background', '#fff url(images/hidden.png) center center no-repeat');
                        $('.shift-block.q2:lt('+(num - 1)+')').css('background', '#fff url(images/hidden.png) center center no-repeat');
                        let code = $('.shift-block[data-num='+num+']').data('code');
                        //let color = $('.shift-block[data-num='+num+']').data('color');
                        $('#shift-slider .slider-handle').text(code);
                        //.css('background', 'conic-gradient(from 45deg, '+color+', '+color+'80)')

                        num -= 1;
                        let start =  $('#shift-header-' + 0).get(0).offsetTop;
                        let pos = $('#shift-header-' + num).get(0).offsetTop;
                        $('.full-content-container').get(0).scrollTop = pos - start;                                                            
                    }",
                ],
            ]); ?>            
        </div>
        
        <div class="full-content-container">
        <?php 
        $count = count($shiftCells);
        foreach($shiftCells as $i => $shiftCell) {
                $num = $i +1;
                $links = '';
                if($shiftCell->links) {
                    $urls = explode(' ', $shiftCell->links);
                    $links = [];
                    foreach($urls as $j => $url) {                        
                        $linkNum = $j + 1;
                        $links[] = Html::a('link '.$linkNum, $url);
                    }
                    $links = Html::tag('div', implode(', ', $links));                    
                }
                $header = Html::tag('div', "Shift $num Core message summary", ['class' => 'shift-content-header', 'id' => 'shift-header-'.$i]);
                $content = Html::tag('div', $shiftCell->content.$links, ['class' => 'shift-content']);
                
                $btn1 = Html::a("Full shift $num messaging", ['content', 'id' => $shiftCell->id], ['class' => 'btn btn-info', 'style' => 'float:right; margin-right: 5px;', 'target' => '_blank']);
                $dis2 = $shiftCell->link_full_deck ? '' : 'disabled';
                $dis3 = $shiftCell->link_pdf ? '' : 'disabled';
                $btn2 = Html::a("Shift $num Full Deck", $shiftCell->link_full_deck, ['class' => "btn btn-info $dis2", 'style' => 'float:right; margin-right: 5px;', 'target' => '_blank']);
                $btn3 = Html::a("Shift $num Message Summary PDF", $shiftCell->link_pdf, ['class' => "btn btn-info $dis3", 'style' => 'float:right; margin-right: 5px;', 'target' => '_blank',]);
                
                echo Html::tag('div', "$header\n$content\n$btn3\n$btn2\n$btn1", ['style' => 'overflow:auto']);
                if($i < $count - 1) {
                    echo Html::tag('div', Icon::show('arrow-right', ['class' => 'arrow-small arrow-bottom']), ['class' => 'container-arrow']);
                }
        }
    } ?>
        </div>
    </div>  
</div>
<p>
    &nbsp;
</p>
<?php
 if($contact && $logbookForm) {
    Modal::begin([
        'title' => "Logbook entry for {$contact->name}",
        'toggleButton' => ['label' => 'Logbook', 'class' => 'btn btn-info', 'style' => 'position: absolute; right: 50px; top: 80px;  box-shadow: 0 5px 0 #7B77FB;'],
        'size' => Modal::SIZE_LARGE,
        'centerVertical' => true,
    ]);

    echo $logbookForm;

    Modal::end();     
 }
