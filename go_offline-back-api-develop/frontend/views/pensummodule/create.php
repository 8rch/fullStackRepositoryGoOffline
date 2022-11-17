<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PensumModule */

$this->title = 'Create Pensum Module';
$this->params['breadcrumbs'][] = ['label' => 'Pensum Module', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pensum-module-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
