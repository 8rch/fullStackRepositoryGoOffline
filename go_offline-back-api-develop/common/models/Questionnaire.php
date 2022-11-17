<?php

namespace common\models;

use Yii;
use \common\models\base\Questionnaire as BaseQuestionnaire;

/**
 * This is the model class for table "questionnaire".
 */
class Questionnaire extends BaseQuestionnaire
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['topic_id', 'type', 'questions', 'answers','dead_line'], 'required'],
                [['topic_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
                [['questions', 'answers', 'content'], 'string'],
                [['created_at', 'updated_at', 'deleted_at', 'dead_line'], 'safe'],
                [['type'], 'string',]
            ]);
    }

}
