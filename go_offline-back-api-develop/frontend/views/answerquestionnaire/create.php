<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AnswerQuestionnaire */

$this->title = 'Create Answer Questionnaire';
$this->params['breadcrumbs'][] = ['label' => 'Answer Questionnaire', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="answer-questionnaire-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
