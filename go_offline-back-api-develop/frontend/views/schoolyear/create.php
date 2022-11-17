<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SchoolYear */

$this->title = 'Create School Year';
$this->params['breadcrumbs'][] = ['label' => 'School Year', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-year-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
