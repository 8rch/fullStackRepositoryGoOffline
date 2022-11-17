<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserPeriod */

$this->title = 'Create User Period';
$this->params['breadcrumbs'][] = ['label' => 'User Period', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-period-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
