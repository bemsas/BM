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

AppAsset::register($this);

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
    $brandLabel = $company->name;
    $brandColor = $company->getColor();    
    if($company->icon) {
        $companyImg = Html::img($company->icon, ['alt' => 'company icon', 'style' => 'width:64px;']);
    }
} else {
    $brandLabel = Yii::$app->name;
    $brandColor = Company::DEFAULT_COLOR;    
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

<header>
    <?php
    NavBar::begin([
        'brandLabel' => $companyImg.$brandLabel,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-main fixed-top',
            'style' => "background: $brandColor;",
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Contacts', 'url' => ['/contact/index'], 'linkOptions' => ['target' => '_blank'], 'visible' => $type !== 'guest'],
            ['label' => 'Logbook', 'url' => ['/logbook/index'], 'linkOptions' => ['target' => '_blank'], 'visible' => $type !== 'guest'],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ', '. $type. ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; My Company <?= date('Y') ?></p>
        <p class="float-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
