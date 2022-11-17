<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\SchoolYear */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'School Year', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-year-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'School Year'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'description',
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
                'attribute' => 'module.name',
                'label' => 'Module'
            ],
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
</div>
