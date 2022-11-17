<?php

namespace common\models;

use Yii;
use \common\models\base\Params as BaseParams;

/**
 * This is the model class for table "params".
 */
class Params extends BaseParams
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name', 'value'], 'required'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['name', 'value'], 'string', 'max' => 255]
        ]);
    }
	
}
