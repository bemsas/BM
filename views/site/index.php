<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Belief map toolkit';
for($i = 'A'; $i < 'C'; $i++) {
    echo $i;    
}
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Belief map toolkit!</h1>        
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <h2>Client vision</h2>

                <?= Html::a('Maps', ['map/index']) ?><br>  
            </div>
            <div class="col-lg-6">
                <h2>Administration</h2>

                <?= Html::a('Maps', ['map/index']) ?><br>                  
            </div>                        
        </div>

    </div>
</div>
