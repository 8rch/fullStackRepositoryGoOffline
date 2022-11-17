<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SchoolYear */

$this->title = 'Save As New School Year: '. ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'School Year', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="school-year-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
