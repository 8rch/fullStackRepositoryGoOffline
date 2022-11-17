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
        <div class="col-sm-8">
            <h2><?= 'User Period'.' '. Html::encode($this->title) ?></h2>
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
        'first_partial_note',
        'second_partial_note',
        [
            'attribute' => 'user.username',
            'label' => 'User',
        ],
        [
            'attribute' => 'period.id',
            'label' => 'Period',
        ],
        [
            'attribute' => 'pensum.id',
            'label' => 'Pensum',
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>Pensum<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnPensum = [
        ['attribute' => 'id', 'visible' => false],
        'code',
        'responsible_name',
    ];
    echo DetailView::widget([
        'model' => $model->pensum,
        'attributes' => $gridColumnPensum    ]);
    ?>
    <div class="row">
        <h4>Period<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnPeriod = [
        ['attribute' => 'id', 'visible' => false],
        'init_date',
        'end_date',
        'end_date_to_deadline',
        'end_date_exam_score_deadline',
    ];
    //var_dump($model->allsPeriod);die();
    echo DetailView::widget([
        'model' => $model->allsPeriod,
        'attributes' => $gridColumnPeriod    ]);
    ?>
    <div class="row">
        <h4>User<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnUser = [
        ['attribute' => 'id', 'visible' => false],
        'username',
        'status',
        'superadmin',
        'registration_ip',
        'bind_to_ip',
        'email',
        'email_confirmed',
    ];
    echo DetailView::widget([
        'model' => $model->user,
        'attributes' => $gridColumnUser    ]);
    ?>
</div>
