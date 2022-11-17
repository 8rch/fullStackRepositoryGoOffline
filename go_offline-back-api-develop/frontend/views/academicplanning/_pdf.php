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
        <div class="col-sm-9">
            <h2><?= 'Academic Planning'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
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
        [
                'attribute' => 'schoolYear.name',
                'label' => 'School Year'
            ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
