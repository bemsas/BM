<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use kartik\icons\Icon;
use app\models\Product;
use app\models\Cell;
use app\models\Logbook;
use yii\web\JqueryAsset;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $userName string */
/* @var $lastLogin string */
/* @var $company app\models\Company */

Icon::map($this, Icon::FA);
//JqueryAsset::register($this);

$this->title = 'My Products';
$this->params['breadcrumbs'][] = $this->title;
$js = '$(function(){
        $(".product-card").on("click", function() {
            location.href = $(this).find("a").prop("href");
        });
    });';
$this->registerJs($js);
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
        'itemOptions' => ['class' => 'product-card'],
        'itemView' => function (Product $model, $key, $index, $widget) {
            $content = Html::a(Html::encode($model->name), ['view', 'id' => $model->id]).Html::tag('div', $model->description);
            $cellCodes = Cell::getCodeList($model->map_id);
            $cellIds = array_flip($cellCodes);
            $logbook = Logbook::findLastByCellIds($cellIds);
            if($logbook) {
                $content .= Html::tag('div', Icon::show('clock').'&nbsp;&nbsp;'.Yii::$app->formatter->asDateTime($logbook->date_in, 'dd MMM | h:m'), ['class' => 'date']);
            }
            return $content;
        },
    ]) ?>

    <?php Pjax::end(); ?>

</div>
<div class="works">
    <h1>How it works</h1>
    <div class="row">
        <div class="col-lg-6"><?=$company->hello_left?></div>
        <div class="col-lg-6"><?=$company->hello_right?></div>
    </div>
</div>