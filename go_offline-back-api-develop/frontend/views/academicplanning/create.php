<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AcademicPlanning */

$this->title = 'Create Academic Planning';
$this->params['breadcrumbs'][] = ['label' => 'Academic Planning', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="academic-planning-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
