<div class="form-group" id="add-questionnaire">
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
        'formName' => 'Questionnaire',
        'checkboxColumn' => false,
        'actionColumn' => false,
        'attributeDefaults' => [
            'type' => TabularForm::INPUT_TEXT,
        ],
        'attributes' => [
            "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden' => true]],
            'type' => ['type' => TabularForm::INPUT_WIDGET, 'widgetClass' => \kartik\select2\Select2::className(),
                'options' => ['data' => ['evaluation' => 'evaluacion', 'reinforcement_evaluation' => 'refuerzo de evaluacion']]],
            'questions' => ['type' => TabularForm::INPUT_WIDGET, 'widgetClass' => \kdn\yii2\JsonEditor::className(),],
            'answers' => ['type' => TabularForm::INPUT_WIDGET, 'widgetClass' => \kdn\yii2\JsonEditor::className(),],
            'content' => ['type' => TabularForm::INPUT_WIDGET,
                'widgetClass' => \mihaildev\ckeditor\CKEditor::className(), 'options' => ['editorOptions' => [
                    'inline' => false
                ]]],
            'dead_line' => ['type' => TabularForm::INPUT_WIDGET, 'widgetClass' => \kartik\datetime\DateTimePicker::className(),],
            'del' => [
                'type' => 'raw',
                'label' => '',
                'value' => function ($model, $key) {
                    return
                        Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                        Html::a('<i class="fas fa-trash"></i>', '#', ['title' => Yii::t('app', 'Delete'), 'onClick' => 'delRowQuestionnaire(' . $key . '); return false;', 'id' => 'questionnaire-del-btn']);
                },
            ],
        ],
        'gridSettings' => [
            'panel' => [
                'heading' => false,
                'type' => GridView::TYPE_DEFAULT,
                'before' => false,
                'footer' => false,
                'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Questionnaire'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowQuestionnaire()']),
            ]
        ]
    ]);
    echo "    </div>\n\n";
    ?>

