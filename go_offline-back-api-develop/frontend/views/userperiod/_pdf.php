<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\UserPeriod */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Period', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-period-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'User Period'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'first_partial_note',
        'second_partial_note',
        [
                'attribute' => 'user.username',
                'label' => 'User'
            ],
        [
                'attribute' => 'period.id',
                'label' => 'Period'
            ],
        [
                'attribute' => 'pensum.id',
                'label' => 'Pensum'
            ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
