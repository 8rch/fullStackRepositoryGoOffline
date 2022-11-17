<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\GeoUserData */

$this->title = $model->long;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Geo User Data'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geo-user-data-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Geo User Data').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            'long',
            'lat',
            'created_at',
            'extra:ntext',
            [
                'attribute' => 'user.id',
                'label' => Yii::t('app', 'User')
            ],
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>
</div>
