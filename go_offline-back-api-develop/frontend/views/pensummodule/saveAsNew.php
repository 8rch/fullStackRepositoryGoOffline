<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PensumModule */

$this->title = 'Save As New Pensum Module: '. ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pensum Module', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="pensum-module-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
