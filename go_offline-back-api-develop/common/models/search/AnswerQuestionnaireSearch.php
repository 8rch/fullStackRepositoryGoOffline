<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AnswerQuestionnaire;

/**
 * common\models\search\AnswerQuestionnaireSearch represents the model behind the search form about `common\models\AnswerQuestionnaire`.
 */
 class AnswerQuestionnaireSearch extends AnswerQuestionnaire
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'questionnaire_id', 'user_id', 'created_by', 'updated_by', 'deleted_by', 'attempt'], 'integer'],
            [['answers_user', 'answer_correct', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['evaluation_is_correct', 'reinforcement_evaluation_is_correct'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AnswerQuestionnaire::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'questionnaire_id' => $this->questionnaire_id,
            'user_id' => $this->user_id,
            'evaluation_is_correct' => $this->evaluation_is_correct,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
            'reinforcement_evaluation_is_correct' => $this->reinforcement_evaluation_is_correct,
            'attempt' => $this->attempt,
        ]);

        $query->andFilterWhere(['like', 'answers_user', $this->answers_user])
            ->andFilterWhere(['like', 'answer_correct', $this->answer_correct]);

        return $dataProvider;
    }
}
