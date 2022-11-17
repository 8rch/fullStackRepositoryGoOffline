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
        <div class="col-sm-8">
            <h2><?= 'Module'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'PDF', 
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'Will open the generated PDF file in a new window'
                ]
            )?>
            <?= Html::a('Save As New', ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>            
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
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
                'attribute' => 'careerSubject.code',
                'label' => 'Career Subject'
            ],
            [
                'attribute' => 'topic.name',
                'label' => 'Topic'
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerAcademicPlanning,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-academic-planning']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Academic Planning'),
        ],
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
                'attribute' => 'pensum.code',
                'label' => 'Pensum'
            ],
                ];
    echo Gridview::widget([
        'dataProvider' => $providerPensumModule,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-pensum-module']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Pensum Module'),
        ],
        'columns' => $gridColumnPensumModule
    ]);
}
?>

    </div>
</div>
