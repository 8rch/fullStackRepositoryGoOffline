<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\AcademicPlanning */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Academic Planning', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="academic-planning-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= 'Academic Planning'.' '. Html::encode($this->title) ?></h2>
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
        [
            'attribute' => 'module.name',
            'label' => 'Module',
        ],
        [
            'attribute' => 'careerSubject.id',
            'label' => 'Career Subject',
        ],
        [
            'attribute' => 'topic.name',
            'label' => 'Topic',
        ],
        [
            'attribute' => 'schoolYear.name',
            'label' => 'School Year',
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>CareerSubject<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnCareerSubject = [
        ['attribute' => 'id', 'visible' => false],
        'code',
        'responsible_name',
    ];
    echo DetailView::widget([
        'model' => $model->careerSubject,
        'attributes' => $gridColumnCareerSubject    ]);
    ?>
    <div class="row">
        <h4>Module<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnModule = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'code',
    ];
    echo DetailView::widget([
        'model' => $model->module,
        'attributes' => $gridColumnModule    ]);
    ?>
    <div class="row">
        <h4>SchoolYear<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnSchoolYear = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'description',
    ];
    echo DetailView::widget([
        'model' => $model->schoolYear,
        'attributes' => $gridColumnSchoolYear    ]);
    ?>
    <div class="row">
        <h4>Topic<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnTopic = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'code',
    ];
    echo DetailView::widget([
        'model' => $model->topic,
        'attributes' => $gridColumnTopic    ]);
    ?>
</div>
