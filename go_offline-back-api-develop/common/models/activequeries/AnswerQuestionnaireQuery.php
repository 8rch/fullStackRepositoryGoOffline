<?php

namespace common\models\activequeries;

/**
 * This is the ActiveQuery class for [[\common\models\activequeries\AnswerQuestionnaire]].
 *
 * @see \common\models\activequeries\AnswerQuestionnaire
 */
class AnswerQuestionnaireQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\activequeries\AnswerQuestionnaire[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\activequeries\AnswerQuestionnaire|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
