<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cell */
/* @var $cellCodes array */
/* @var $code string */
/* @var $shifts \app\models\Shift[] */

$map = $model->answer1->map;
$this->title = $code;
$this->params['breadcrumbs'][] = ['label' => 'Maps', 'url' => ['map/index']];
$this->params['breadcrumbs'][] = ['label' => $map->name, 'url' => ['map/view', 'id' => $map->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cell-view">

    <div class="row">
        <div class="col-lg-4">
            <h1 class="bg-<?=$code ?>"><?= $code ?></h1>
        </div>
        <div class="col-lg-8">
            <h2 class="bg-<?=$code ?>"><?= $code ?> Profile</h2>
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="bg-<?=$code ?>"><?= $map->question1_text ?></h3>
                </div>
                <div class="col-lg-6">
                    <h3 class="bg-<?=$code ?>"><?= $map->question2_text ?></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="answer-block"> <?=$model->answer1->content ?></div>
                </div>
                <div class="col-lg-6">
                    <div class="answer-block"> <?=$model->answer2->content ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <h5 class="bg-<?=$code ?>"> Ideal Journey and Approach Shifts</h5>
        </div>        
        <div class="col-lg-8">
            <h5 class="bg-<?=$code ?>"><?= $code ?> Approach & Funding Shifts</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <?php 
                if($code == 'A1') {
                    echo Html::tag("div", "No approach shifts required for A1 profile payers", ['class' => "answer-block"]), "\n";
                } else {
                    $rows = array_slice(['A', 'B', 'C', 'D', 'E'], 0, $map->size);
                    $columns = array_slice(['5', '4', '3', '2', '1'], 5 - $map->size, $map->size);
                    $wide = 7 - $map->size;
                    foreach($rows as $row) {
                        echo Html::beginTag('div', ['class' => 'row']);
                        foreach($columns as $column) {
                            $arrow = '';
                            foreach($shifts as $shift) {
                                if($cellCodes[$shift->cell_start_id] == $row.$column) {
                                    $endCell = $cellCodes[$shift->cell_end_id];
                                    if($endCell[0] == $row) {
                                        $vectorClass = '';
                                    } elseif($endCell[1] == $column) {
                                        $vectorClass = 'arrow-top';
                                    } else {
                                        $vectorClass = 'arrow-right-top';
                                    }
                                    $arrow = Html::img('images/arrow.png', ['class' => "arrow $vectorClass"]);
                                }
                            }                            
                            echo Html::tag("div", $row.$column. $arrow, ['class' => "col-lg-$wide cell bg-{$row}{$column}"]), "\n";
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
        <div class="col-lg-1">
            <div class="row">
                <div class="bg-<?=$code ?> shift-title"> <?= $map->question1_text ?></div>
            </div>
            <div class="row">
                <div class="bg-<?=$code ?> shift-title"> <?= $map->question2_text ?></div>
            </div>            
        </div>
        <div class="col-lg-7">
            <div class="row">
                <div class="col-lg-<?= $wide?>">
                    <div class="bg-<?=$code ?> shift-block"> <?=$model->answer1->content ?></div>
                </div>
                <?php
                    foreach($shifts as $shift) { ?>
                        <div class="col-lg-<?= $wide?>">
                            <div class="bg-<?=$cellCodes[$shift->cell_end_id] ?> shift-block"> <?=$shift->cellEnd->answer1->content ?></div>
                        </div>
                    <?php }
                ?>                
            </div>
            <div class="row" style="margin-top: 5px">
                <div class="col-lg-<?= $wide?>">
                    <div class="bg-<?=$code ?> shift-block"> <?=$model->answer2->content ?></div>
                </div>
                <?php
                    foreach($shifts as $shift) { ?>
                        <div class="col-lg-<?= $wide?>">
                            <div class="bg-<?=$cellCodes[$shift->cell_end_id] ?> shift-block"> <?=$shift->cellEnd->answer2->content ?></div>
                        </div>
                    <?php }
                ?>
            </div>
            <div class="row" style="margin-top: 5px">
                <div class="col-lg-<?= $wide?>">
                    <div class="bg-<?=$code ?>"> 
                        <?=$code ?>
                        <image src="images/arrow.png" class="arrow">
                    </div>
                </div>
                <?php
                    foreach($shifts as $shift) { ?>
                        <div class="col-lg-<?= $wide?>">
                            <div class="bg-<?=$cellCodes[$shift->cell_end_id] ?>"> 
                                <image src="images/arrow.png" class="arrow">
                                <?=$cellCodes[$shift->cell_end_id] ?>
                            </div>
                        </div>
                    <?php }
                ?>
            </div>            
        </div>
        <?php } ?>
    </div>
    <div class="row">
        <?= Html::a('back to map', ['map/view', 'id' => $model->answer1->map_id], ['class' => 'btn btn-info']) ?>
    </div>
</div>
