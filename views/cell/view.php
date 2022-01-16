<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cell */
/* @var $cellCodes array */
/* @var $code string */
/* @var $shifts \app\models\Shift[] */

$this->title = $code;
$this->params['breadcrumbs'][] = ['label' => 'Maps', 'url' => ['map/index']];
$this->params['breadcrumbs'][] = ['label' => $model->answer1->map->name, 'url' => ['map/view', 'id' => $model->answer1->map_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .bg-A1 {
        background: #EFEECC;
    }
    .bg-A2 {
        background: #E7E5AA;
    }
    .bg-A3 {
        background: #DEDB7D;
    }
    .bg-A4 {
        background: #D5D10E;
    }
    .bg-B1 {
        background: #E0E8E9;
    }
    .bg-B2 {
        background: #CEDBDD;
    }
    .bg-B3 {
        background: #BACCCF;
    }
    .bg-B4 {
        background: #A2BDC1;
    }
    .bg-C1 {
        background: #DEE0E0;
    }
    .bg-C2 {
        background: #CACDCD;
    }
    .bg-C3 {
        background: #B4B9B9;
    }
    .bg-C4 {
        background: #9AA1A1;
    }
    .bg-D1 {
        background: #CDCFD2;
    }
    .bg-D2 {
        background: #ADB1B6;
    }
    .bg-D3 {
        background: #898A92;
    }
    .bg-D4 {
        background: #667A8A;
    }
    
    
    h1, h2, h3, h5 {
        padding: 5px;        
    }
    h1 {
        text-align: right;
    }
    .answer-block {
        background: #eee;
        height: 200px;
    }
    h5 {
        margin-top: 10px;
    }
    .cell {
        display: inline-block;
        width: 80px;
        height: 80px;        
        text-align: left;
        border: 1px solid #fff;
        margin: 0;
        padding: 5px;
        color: #000;
    }
    .shift-block {
        height: 160px;
        font-size: 9pt;
    }
    .shift-title {
        height: 160px;
        writing-mode: vertical-lr;
        text-align: center;
        font-size: 12pt;
        text-transform: uppercase;
    }    
</style>
<div class="cell-view">

    <div class="row">
        <div class="col-lg-4">
            <h1 class="bg-<?=$code ?>"><?= $code ?></h1>
        </div>
        <div class="col-lg-8">
            <h2 class="bg-<?=$code ?>"><?= $code ?> Profile</h2>
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="bg-<?=$code ?>"><?= $model->answer1->map->question1_text ?></h3>
                </div>
                <div class="col-lg-6">
                    <h3 class="bg-<?=$code ?>"><?= $model->answer1->map->question2_text ?></h3>
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
                foreach(['A', 'B', 'C', 'D'] as $position1) {
                    foreach(['4', '3', '2', '1'] as $position2) {
                        echo Html::tag("div", $position1.$position2, ['class' => "cell bg-{$position1}{$position2}"]), "\n";
                    }
                }                                
            ?>            
        </div>
        <div class="col-lg-8">            
            <div class="row">
                <div class="col-lg-1">
                    <div class="bg-<?=$code ?> shift-title"> <?= $model->answer1->map->question1_text ?></div>
                </div>
                <div class="col-lg-2">
                    <div class="bg-<?=$code ?> shift-block"> <?=$model->answer1->content ?></div>
                </div>
                <?php
                    foreach($shifts as $shift) { ?>
                        <div class="col-lg-2">
                            <div class="bg-<?=$cellCodes[$shift->cell_end_id] ?> shift-block"> <?=$shift->cellEnd->answer1->content ?></div>
                        </div>
                    <?php }
                ?>                
            </div>
            <div class="row" style="margin-top: 5px">
                <div class="col-lg-1">
                    <div class="bg-<?=$code ?> shift-title"> <?= $model->answer1->map->question2_text ?></div>
                </div>
                <div class="col-lg-2">
                    <div class="bg-<?=$code ?> shift-block"> <?=$model->answer2->content ?></div>
                </div>
                <?php
                    foreach($shifts as $shift) { ?>
                        <div class="col-lg-2">
                            <div class="bg-<?=$cellCodes[$shift->cell_end_id] ?> shift-block"> <?=$shift->cellEnd->answer2->content ?></div>
                        </div>
                    <?php }
                ?>
            </div>           
        </div>
    </div>
</div>
