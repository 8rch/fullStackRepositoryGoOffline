<?php

namespace common\models;

use Yii;
use \common\models\base\SchoolYear as BaseSchoolYear;

/**
 * This is the model class for table "school_year".
 */
class SchoolYear extends BaseSchoolYear
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name', 'description',], 'required'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255]
        ]);
    }
	
}
