<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GeoUserData */

$this->title = Yii::t('app', 'Save As New {modelClass}: ', [
        'modelClass' => 'Geo User Data',
    ]). ' ' . $model->long;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Geo User Data'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->long, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Save As New');
?>
<div class="geo-user-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
