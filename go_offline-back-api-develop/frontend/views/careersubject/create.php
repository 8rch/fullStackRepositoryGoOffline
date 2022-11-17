<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CareerSubject */

$this->title = 'Create Career Subject';
$this->params['breadcrumbs'][] = ['label' => 'Career Subject', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="career-subject-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
