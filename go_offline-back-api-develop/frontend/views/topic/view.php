<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Topic */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Topic'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topic-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'Topic').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('app', 'PDF'), 
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
                ]
            )?>
            <?= Html::a(Yii::t('app', 'Save As New'), ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>            
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>


    <div class="row">
<?php
if($providerContentTopic->totalCount){
    $gridColumnContentTopic = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        'name',
            'code',
            'content',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerContentTopic,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-content-topic']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Content Topic')),
        ],
        'columns' => $gridColumnContentTopic
    ]);
}
?>

    </div>
    
    <div class="row">
<?php
if($providerQuestionnaire->totalCount){
    $gridColumnQuestionnaire = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            'type',
            ['attribute'=>'questions'],
            'answers',
            ['attribute'=>'content', 'format' => 'raw',],
            'dead_line'
    ];
    echo Gridview::widget([
        'dataProvider' => $providerQuestionnaire,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-questionnaire']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Questionnaire')),
        ],
        'columns' => $gridColumnQuestionnaire
    ]);
}
?>
    </div>
</div>
