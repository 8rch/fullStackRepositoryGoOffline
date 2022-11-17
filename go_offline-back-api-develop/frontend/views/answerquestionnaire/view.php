<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\AnswerQuestionnaire */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Answer Questionnaire', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="answer-questionnaire-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= 'Answer Questionnaire'.' '. Html::encode($this->title) ?></h2>
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
            'attribute' => 'questionnaire.id',
            'label' => 'Questionnaire',
        ],
        [
            'attribute' => 'user.username',
            'label' => 'User',
        ],
        'answers_user',
        'answer_correct',
        'evaluation_is_correct:boolean',
        'reinforcement_evaluation_is_correct:boolean',
        'attempt',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>Questionnaire<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnQuestionnaire = [
        ['attribute' => 'id', 'visible' => false],
        'topic_id',
        'type',
        'content',
        'questions',
        'answers',
    ];
    echo DetailView::widget([
        'model' => $model->questionnaire,
        'attributes' => $gridColumnQuestionnaire    ]);
    ?>
    <div class="row">
        <h4>User<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnUser = [
        ['attribute' => 'id', 'visible' => false],
        'username',
        'auth_key',
        'password_hash',
        'confirmation_token',
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
