<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CareerSubject */

$this->title = 'Update Career Subject: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Career Subject', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="career-subject-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
