<?php

namespace common\models;

use Yii;
use \common\models\base\Period as BasePeriod;

/**
 * This is the model class for table "period".
 */
class Period extends BasePeriod
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['init_date', 'end_date', 'end_date_to_deadline', 'end_date_exam_score_deadline'], 'required'],
                [['init_date', 'end_date', 'end_date_to_deadline', 'end_date_exam_score_deadline', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
                [['created_by', 'updated_by', 'deleted_by'], 'integer']
            ]);
    }

}
