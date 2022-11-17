<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Module */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Module', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Module'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'code',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerAcademicPlanning->totalCount){
    $gridColumnAcademicPlanning = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                [
                'attribute' => 'careerSubject.id',
                'label' => 'Career Subject'
            ],
        [
                'attribute' => 'topic.name',
                'label' => 'Topic'
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerAcademicPlanning,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Academic Planning'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnAcademicPlanning
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerPensumModule->totalCount){
    $gridColumnPensumModule = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'pensum.id',
                'label' => 'Pensum'
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
</div>
