<?php

namespace common\models;

use Yii;
use \common\models\base\AcademicPlanning as BaseAcademicPlanning;

/**
 * This is the model class for table "academic_planning".
 */
class AcademicPlanning extends BaseAcademicPlanning
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['module_id', 'career_subject_id', 'topic_id'], 'required'],
            [['module_id', 'career_subject_id', 'topic_id', 'created_by', 'updated_by', 'deleted_by', 'school_year_id'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe']
        ]);
    }
	
}
