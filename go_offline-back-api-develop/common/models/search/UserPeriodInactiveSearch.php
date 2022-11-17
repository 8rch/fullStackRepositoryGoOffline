<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserPeriod;

/**
 * common\models\search\UserPeriodInactiveSearch represents the model behind the search form about `common\models\UserPeriod`.
 */
 class UserPeriodInactiveSearch extends UserPeriod
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'period_id', 'created_by', 'updated_by', 'deleted_by', 'pensum_id'], 'integer'],
            [['first_partial_note', 'second_partial_note'], 'number'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
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
        $query = UserPeriod::find();

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
            'first_partial_note' => $this->first_partial_note,
            'second_partial_note' => $this->second_partial_note,
            'user_id' => $this->user_id,
            'period_id' => $this->period_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'pensum_id' => $this->pensum_id,
        ]);
        $query->where('deleted_at IS NOT NULL');

        return $dataProvider;
    }
}
