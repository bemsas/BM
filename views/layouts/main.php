<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use app\models\User;
use app\models\Company;
use kartik\icons\Icon;

AppAsset::register($this);
Icon::map($this, Icon::FAS);  
Icon::map($this, Icon::FAR);  

$this->title = Yii::$app->name;

if(Yii::$app->user->isGuest) {
    $type = 'guest';
    $company = null;    
} else {
    $types = User::getTypeList();
    $type = $types[Yii::$app->user->identity->user->type];
    $company = Yii::$app->user->identity->user->company;
    
}
$companyImg = '';
if($company) {    
    $brandColor = $company->getColor();    
    $textColor = $company->color_text;
    $brandLabel = Html::tag('span', $company->name, ['style' => "color: $textColor; font-size: 22px;"]);
    if($company->icon) {
        $companyImg = Html::img($company->icon, ['class' => 'user-img', 'alt' => 'company icon']);        
    }
} else {
    $brandColor = Company::DEFAULT_COLOR;    
    $textColor = '#fff';
    $brandLabel = Html::tag('span', Yii::$app->name, ['style' => "color: $textColor; font-size: 22px;"]);
    $companyImg = Html::img('images/banner.png', ['class' => 'user-img', 'alt' => 'company icon']);        
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header class="page-header">
    <?php    
    NavBar::begin([
        'brandLabel' => $brandLabel,
        'id' => 'header-navbar',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-main',
            'style' => "background: $brandColor !important;",
        ],
        'innerContainerOptions' => [
           'style' => 'max-width: 100% !important'
        ],
    ]);    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'encodeLabels' => false,
        'items' => [
            /*[
                'label' => $companyImg.$brandLabel, 
                'url' => false,
                'encodeLabels' => false,
                'options' => ['style' => "background: $brandColor"],
            ],*/

            // ['label' => Icon::show('home').' Home', 'url' => ['/site/index'], 'visible' => $type !== 'guest', 'linkOptions' => ['style' => "color: $textColor"]],
            // ['label' => Icon::show('users').' Contacts', 'url' => ['/contact/index'], 'visible' => false /*$type !== 'guest'*/, 'linkOptions' => ['style' => "color: $textColor"]],
            // ['label' => Icon::show('book').' Logbook', 'url' => ['/logbook/index'], 'visible' => false /*$type !== 'guest'*/, 'linkOptions' => ['style' => "color: $textColor"]],


            ['label' => 'Home', 'url' => ['/site/index'], 'visible' => $type !== 'guest', 'linkOptions' => ['style' => "color: $textColor"]],
            ['label' => 'Contacts', 'url' => ['/contact/index'], 'visible' => false /*$type !== 'guest'*/, 'linkOptions' => ['style' => "color: $textColor"]],
            ['label' => 'Logbook', 'url' => ['/logbook/index'], 'visible' => false /*$type !== 'guest'*/, 'linkOptions' => ['style' => "color: $textColor"]],
            ['label' => 'Introduction and Guidance', 'url' => ['/contact/index'], 'visible' => $type !== 'guest', 'linkOptions' => ['style' => "color: $textColor"]],
            ['label' => 'Help', 'url' => ['/logbook/index'], 'visible' => $type !== 'guest', 'linkOptions' => ['style' => "color: $textColor"]],
            Yii::$app->user->isGuest ? (
                ['label' => Icon::show('sign-in-alt'), 'url' => ['/site/login'], 'visible' => $type !== 'guest', 'linkOptions' => ['style' => "color: $textColor"]]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    Html::tag('span', 'Logout', ['style' => "color: $textColor"]),
                    ['class' => 'logout-btn']
                )
                . Html::endForm()
                . '</li>'
                // <li style="float:right">'
                // . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                // . Html::submitButton(
                //     Icon::show('sign-out-alt', ['style' => "font-size: 28px; color: $textColor"]).Html::tag('span', 'Logout', ['style' => "color: $textColor"]),
                //     ['class' => 'btn btn-link logout', ['style' => "color: $textColor"]]
                // )
                // . Html::endForm()
                // . '</li>'
            ),            
        ],
    ]);
    //echo $companyImg;
    NavBar::end();    
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <!--<div style="height: 60px;">&nbsp;</div>!-->
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <!--<p class="float-left">&copy; My Company <?= date('Y') ?></p>
        <p class="float-right"><?= Yii::powered() ?></p>!-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
