<?php

namespace common\models;

use Yii;
use \common\models\base\UserPeriod as BaseUserPeriod;

/**
 * This is the model class for table "user_period".
 */
class UserPeriod extends BaseUserPeriod
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['first_partial_note', 'second_partial_note'], 'number'],
            [['user_id', 'period_id', 'pensum_id'], 'required'],
            [['user_id', 'period_id', 'created_by', 'updated_by', 'deleted_by', 'pensum_id'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe']
        ]);
    }
	
}
