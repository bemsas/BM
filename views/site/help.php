<?php

use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $company app\models\Company */
/* @var $content string */

Icon::map($this, Icon::FA);

$this->title = 'Help instructions';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="works">
    <h1><?=$this->title?></h1>
    <?= $content ?>
</div>