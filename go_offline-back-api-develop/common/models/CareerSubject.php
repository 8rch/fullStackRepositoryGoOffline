<?php

namespace common\models;

use Yii;
use \common\models\base\CareerSubject as BaseCareerSubject;

/**
 * This is the model class for table "career_subject".
 */
class CareerSubject extends BaseCareerSubject
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['code', 'responsible_name',], 'required'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['code', 'responsible_name'], 'string', 'max' => 255]
        ]);
    }
	
}
