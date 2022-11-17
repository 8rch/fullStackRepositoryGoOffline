<?php

namespace common\models;

use Yii;
use \common\models\base\AnswerQuestionnaire as BaseAnswerQuestionnaire;

/**
 * This is the model class for table "answer_questionnaire".
 */
class AnswerQuestionnaire extends BaseAnswerQuestionnaire
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['questionnaire_id', 'user_id', 'answers_user', 'answer_correct',], 'required'],
            [['questionnaire_id', 'user_id', 'created_by', 'updated_by', 'deleted_by','attempt'], 'integer'],
            [['answers_user', 'answer_correct'], 'string'],
            [['evaluation_is_correct', 'reinforcement_evaluation_is_correct'], 'boolean'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe']
        ]);
    }
	
}
