<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AcademicPlanning */

$this->title = 'Save As New Academic Planning: '. ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Academic Planning', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="academic-planning-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
