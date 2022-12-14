<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Period */

?>
<div class="period-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'init_date',
        'end_date',
        'end_date_to_deadline',
        'end_date_exam_score_deadline',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>