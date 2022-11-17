<?php

namespace common\models;

use Yii;
use \common\models\base\ContentTopic as BaseContentTopic;

/**
 * This is the model class for table "content_topic".
 */
class ContentTopic extends BaseContentTopic
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['topic_id', 'name', 'code', 'content'], 'required'],
                [['topic_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
                [['created_at', 'updated_at', 'deleted_at'], 'safe'],
                [['name', 'code', 'content'], 'string']
            ]);
    }

}
