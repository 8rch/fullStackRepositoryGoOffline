<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->pensumCareerSubjects,
        'key' => 'id'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'pensum.id',
                'label' => Yii::t('app', 'Pensum')
            ],
        [
                'attribute' => 'careerSubject.id',
                'label' => Yii::t('app', 'Career Subject')
            ],
        [
                'attribute' => 'module.id',
                'label' => Yii::t('app', 'Module')
            ],
        [
            'class' => 'yii\grid\ActionColumn',
            'controller' => 'pensum-career-subject'
        ],
    ];
    
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'containerOptions' => ['style' => 'overflow: auto'],
        'pjax' => true,
        'beforeHeader' => [
            [
                'options' => ['class' => 'skip-export']
            ]
        ],
        'export' => [
            'fontAwesome' => true
        ],
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'showPageSummary' => false,
        'persistResize' => false,
    ]);
