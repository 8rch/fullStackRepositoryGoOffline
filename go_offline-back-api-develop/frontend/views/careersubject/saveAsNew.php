<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CareerSubject */

$this->title = 'Save As New Career Subject: '. ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Career Subject', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="career-subject-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
