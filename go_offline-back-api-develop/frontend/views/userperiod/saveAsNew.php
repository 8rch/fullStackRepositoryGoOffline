<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserPeriod */

$this->title = 'Save As New User Period: '. ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Period', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="user-period-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
