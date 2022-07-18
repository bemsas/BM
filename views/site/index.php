<?php

/* @var $this yii\web\View */
/* @var $isAdmin bool */
/* @var $isManager bool */
/* @var $company \app\models\Company */

use yii\helpers\Html;
use kartik\icons\Icon;
// use Yii;
//cabinet-filing
//
?>
<style>
    .menu-block {
        background: <?=$company->color ?> !important;
    }
</style>
<div class="site-index">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/web/index.php">Home</a></li>
        </ol>
    </nav>  
    

    <div class="promo">
        <div class="promo__container">
            <div class="promo__row">
                <h1 class="promo__title">Welcome to</h1>
                <div class="promo__text">
                    <p>
                    BeST is a planning tool for customer-facing teams that allows them to plan their next best content engagement with an individual stakeholder or customer, and work over time towards a target mindset and behaviour.
                    </p>
                    <p>
                    Each of your stakeholders or customers will have a different starting point, so the tool allows you map their current belief, behaviour and practice then recommends the next best belief, behaviour or practice shift for them and the messages to enable this.
                    </p>
                    <p>
                        <strong>
                            The tool has 5 components:
                        </strong>
                    </p>

                    <ul>
                        <li>A diagnostic that allows you to map the current beliefs, behaviours and practice of a target stakeholder.</li>
                        <li>A belief map that recommends the next best belief, behaviour or practice shift for that stakeholder</li>
                        <li>Recommended messages to enable that shift</li>
                        <li>Supporting resources for engagement</li>
                        <li>Measurement of engegement with customers</li>
                    </ul>
                    
                    
                    <p>
                    The belief map has an Y axis that outlines a series of different stakeholder beliefs , while the X axis indicates various stakeholder practices/ behaviours, These have been agreed in advance  of developing your tool.
                    </p>
                    <p>
                    By diagnosing and mapping the current beleif and practices or behaviours, the tool provides a pathway for progressive customer engagament
                    </p>
                </div>

                <div class="promo__info">
                    <h2 class="promo__heading">Belief Map Framework</h2>
                    <div class="promo__image">
                        <img src="/web/images/promoim.png" alt="" class="promo__img">
                    </div>
                </div>
            </div>

            <div class="promo__row">
                <h1 class="promo__title">Compliance</h1>
                <div class="promo__text">
                    <p>The  Tool and supporting materials have all been approved at Global team level. You will need to ensure they comply with your local regulations.</p>

                    <p>For GDPR purposes, stakeholder initials only can be used for the diagnostic. The tool does not collect or store any other information about stakeholders without their consent.</p>

                    <p>Information held is stored securely on the our company system and is made available only to those who need it to perform their roles. Information should be deleted when it is no longer required for the purpose of negotiation.</p>
                </div>
                <div class="promo__actions">
                    <a href="#" class="btn btn-info promo__button">start</a>
                </div>
            </div>
        </div>
    </div>

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4"><?= Yii::$app->name ?></h1>
        <hr>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4 menu-block">

                <h2>&nbsp; <?=Icon::show('briefcase', ['style' => 'float:right;']) ?></h2>
                <?= Html::a('Products', ['product/list']) ?><br>
                <?= Html::a('Belief maps', ['map/index']) ?><br>
                <?= Html::a('Contacts', ['contact/index', 'all' => 1]) ?><br>
                <?= Html::a('Logbook', ['logbook/index', 'all' => 1]) ?><br>
                <?php if($isManager) {
                    echo Html::a('Your company users', ['user/index']), '<br>';
                } 
                ?>
            </div>
            <?php if($isAdmin) { ?>
                <div class="col-lg-4 menu-block admin">
                    <h2>&nbsp; <?=Icon::show('wrench', ['style' => 'float:right;']) ?></h2>

                    <?= Html::a('Products', ['product/index']) ?><br>
                    <?= Html::a('Belief maps', ['map/index']) ?><br>
                    <?= Html::a('Companies', ['company/index']) ?><br>
                    <?= Html::a('Users', ['user/index']) ?><br>
                    <?= Html::a('All contacts', ['contact/index', 'all' => 1]) ?><br>
                    <?= Html::a('Pages', ['page/index']) ?><br>
                </div>                 
            <?php } ?>
        </div>

    </div> 
</div>
