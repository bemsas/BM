<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use kartik\icons\Icon;
use app\models\Product;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $userName string */
/* @var $lastLogin string */

Icon::map($this, Icon::FA);

$this->title = 'My Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-hello">
    <?= Icon::show('exclamation-circle')?> Welcome back, <?=$userName ?>! You last logged on <?=$lastLogin ?>.
</div>
<div class="product-list">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>    

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function (Product $model, $key, $index, $widget) {
            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]).Html::tag('div', $model->description);
        },
    ]) ?>

    <?php Pjax::end(); ?>

</div>
<div class="product-list-info">
    <h1>How it works</h1>
    <p>
        The disease is most common in the elderly, with the highest proportion of costs attributed to hospitalisations<br>
        <br>
        * The disease affects approximately 8% of the adult population in Europe 1<br>
        * It affects as many as 6 % of people > 60 years of age 1<br>
        <br>
        Patients with the disease had a decreased adjusted HRQoL score of 4.7, reflecting a poorer. European guidelines recommend screening for patients with the disease.<br>
        <br>
        The European guidelines state ‘’ diagnostics tests should be used for initial assessment of a patient with newly diagnosed disease in order to evaluate their suitability for particular therapies’.
    </p>
    <p>
        Patients with the disease had a decreased adjusted HRQoL score of 4.7, reflecting a poorer. European guidelines recommend screening for patients with the disease.<br>
        <br>
        The European guidelines state ‘’ diagnostics tests should be used for initial assessment of a patient with newly diagnosed disease in order to evaluate their suitability for particular therapies’.<br>
        <br>
        The limitations of current therapies<br>
        <br>
        Current therapies are associated with substantial toxicity, which contributes to morbidity and mortality<br>
        <br>
        Current therapies are associated with substantial toxicity, due to non-specific effects, causing adverse events.
    </p>
</div>