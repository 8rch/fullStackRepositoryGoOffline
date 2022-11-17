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
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Topic').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'code',
        [
                'attribute' => 'module.id',
                'label' => Yii::t('app', 'Module')
            ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
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
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Content Topic')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
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
        'questions',
        'answers',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerQuestionnaire,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Questionnaire')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnQuestionnaire
    ]);
}
?>
    </div>
</div>
