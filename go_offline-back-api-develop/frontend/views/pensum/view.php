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
        <div class="col-sm-8">
            <h2><?= 'Pensum'.' '. Html::encode($this->title) ?></h2>
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
                'label' => 'Period',
                'value'=>'period.init_date'
            ],
                ];
    echo Gridview::widget([
        'dataProvider' => $providerUserPeriod,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-user-period']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('User Period'),
        ],
        'columns' => $gridColumnUserPeriod
    ]);
}
?>

    </div>
</div>
