<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\CareerSubject */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Career Subject', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="career-subject-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Career Subject'.' '. Html::encode($this->title) ?></h2>
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
if($providerAcademicPlanning->totalCount){
    $gridColumnAcademicPlanning = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'module.name',
                'label' => 'Module'
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
