<?php

use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $company app\models\Company */

Icon::map($this, Icon::FA);

$this->title = 'Introduction and Guidance';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="works">
    <h1>How it works</h1>
    <div class="row">
        <div class="col-lg-6"><?=$company->hello_left?></div>
        <div class="col-lg-6"><?=$company->hello_right?></div>
    </div>
</div>