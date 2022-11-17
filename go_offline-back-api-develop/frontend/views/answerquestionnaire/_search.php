<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\AnswerQuestionnaireSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-answer-questionnaire-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'questionnaire_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Questionnaire::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => 'Choose Questionnaire'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'user_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => 'Choose User'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'answers_user')->textInput(['placeholder' => 'Answers User']) ?>

    <?= $form->field($model, 'answer_correct')->textInput(['placeholder' => 'Answer Correct']) ?>

    <?php /* echo $form->field($model, 'evaluation_is_correct')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'reinforcement_evaluation_is_correct')->checkbox() */ ?>

    <?php /* echo $form->field($model, 'attempt')->textInput(['placeholder' => 'Attempt']) */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
