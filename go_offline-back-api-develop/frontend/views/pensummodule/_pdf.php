<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\PensumModule */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pensum Module', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pensum-module-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Pensum Module'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'pensum.id',
                'label' => 'Pensum'
            ],
        [
                'attribute' => 'module.name',
                'label' => 'Module'
            ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
