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
        <div class="col-sm-9">
            <h2><?= 'Answer Questionnaire'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'questionnaire.id',
                'label' => 'Questionnaire'
            ],
        [
                'attribute' => 'user.username',
                'label' => 'User'
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
</div>
