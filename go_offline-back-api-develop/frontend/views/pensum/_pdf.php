<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Pensum */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pensum', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pensum-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Pensum'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'code',
        'responsible_name',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerPensumModule->totalCount){
    $gridColumnPensumModule = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                [
                'attribute' => 'module.name',
                'label' => 'Module'
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerPensumModule,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Pensum Module'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnPensumModule
    ]);
}
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
                'attribute' => 'user.username',
                'label' => 'User'
            ],
        [
                'attribute' => 'period.id',
                'label' => 'Period'
            ],
            ];
    echo Gridview::widget([
        'dataProvider' => $providerUserPeriod,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('User Period'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnUserPeriod
    ]);
}
?>
    </div>
</div>
