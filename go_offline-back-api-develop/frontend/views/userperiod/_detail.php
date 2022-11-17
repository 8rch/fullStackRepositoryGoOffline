<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\UserPeriod */

$webPath = Yii::$app->Util->getPublishAssetDirectory();
$this->registerJsFile($webPath . '/_detail.js');

?>
<div class="user-period-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            'first_partial_note',
            'second_partial_note',
            [
                'attribute' => 'user.username',
                'label' => 'User',
            ],
            [
                'attribute' => 'period.id',
                'label' => 'Period',
            ],
            [
                'attribute' => 'pensum.id',
                'label' => 'Pensum',
            ],
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>
    <div class="userperiod_extradetail">
        <button
                data-model_pensum_id="<?= $model->pensum->id ?>"
                data-model_period_id="<?= $model->period->id ?>"
                data-model_user_id="<?= $model->user->id ?>"
                onclick="getPensumDetailed(this,
                        '<?= Url::toRoute('userperiod/ajax-g-pensum-detailed') ?>')">
            Ver detalle del pensum
        </button>
    </div>
</div>