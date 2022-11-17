<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GeoUserData */

$this->title = Yii::t('app', 'Create Geo User Data');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Geo User Data'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geo-user-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
