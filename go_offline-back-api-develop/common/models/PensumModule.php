<?php

namespace common\models;

use Yii;
use \common\models\base\PensumModule as BasePensumModule;

/**
 * This is the model class for table "pensum_module".
 */
class PensumModule extends BasePensumModule
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['pensum_id', 'module_id'], 'required'],
            [['pensum_id', 'module_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
        ]);
    }
	
}
