<div class="form-group" id="add-content-topic">
<?php
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;

$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pageSize' => -1
    ]
]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'ContentTopic',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden'=>true]],
        'name' => ['type' => TabularForm::INPUT_TEXT,'columnOptions'=>['width'=>'150px'],],
        'code' => ['type' => TabularForm::INPUT_TEXT,'columnOptions'=>['width'=>'150px'],],
        'content' => [ 'type'=>TabularForm::INPUT_WIDGET,
            'widgetClass'=>\mihaildev\ckeditor\CKEditor::className(), 'options'=>['editorOptions' => [
                'inline' => true
            ]]],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="fas fa-trash"></i>', '#', ['title' =>  Yii::t('app', 'Delete'), 'onClick' => 'delRowContentTopic(' . $key . '); return false;', 'id' => 'content-topic-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Content Topic'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowContentTopic()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

