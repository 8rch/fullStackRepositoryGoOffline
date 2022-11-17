<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\PeriodSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-period-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'init_date')->textInput(['placeholder' => 'Init Date']) ?>

    <?= $form->field($model, 'end_date')->textInput(['placeholder' => 'End Date']) ?>

    <?= $form->field($model, 'end_date_to_deadline')->textInput(['placeholder' => 'End Date To Deadline']) ?>

    <?= $form->field($model, 'end_date_exam_score_deadline')->textInput(['placeholder' => 'End Date Exam Score Deadline']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
