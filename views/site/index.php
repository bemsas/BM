<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
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
                <?= Html::a('Contacts', ['contact/index']) ?><br>
                <?= Html::a('Logbook', ['logbook/index']) ?><br>
            </div>
            <div class="col-lg-6">
                <h2>Administration</h2>

                <?= Html::a('Maps', ['map/index']) ?><br>
                <?= Html::a('Companies', ['company/index']) ?><br>
                <?= Html::a('Users', ['user/index']) ?><br>
                <?= Html::a('All contacts', ['contact/index', 'all' => 1]) ?><br>
            </div>                        
        </div>

    </div>
</div>
