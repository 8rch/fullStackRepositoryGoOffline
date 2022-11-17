<?php

namespace common\models;

use Yii;
use \common\models\base\Topic as BaseTopic;

/**
 * This is the model class for table "topic".
 */
class Topic extends BaseTopic
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['name', 'code'], 'required'],
                [['created_at', 'updated_at', 'deleted_at'], 'safe'],
                [['created_by', 'updated_by', 'deleted_by'], 'integer'],
                [['name', 'code'], 'string', 'max' => 255]
            ]);
    }

}
