<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Period */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Period'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="period-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Period').' '. Html::encode($this->title) ?></h2>
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
    
    <div class="row">
<?php
if($providerUserPeriod->totalCount){
    $gridColumnUserPeriod = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'first_partial_note',
        'second_partial_note',
        [
                'attribute' => 'user.id',
                'label' => Yii::t('app', 'User')
            ],
                [
                'attribute' => 'pensum.id',
                'label' => Yii::t('app', 'Pensum')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerUserPeriod,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'User Period')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnUserPeriod
    ]);
}
?>
    </div>
</div>
