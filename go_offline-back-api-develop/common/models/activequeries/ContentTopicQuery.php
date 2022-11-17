<?php

namespace common\models\activequeries;

/**
 * This is the ActiveQuery class for [[\common\models\activequeries\ContentTopic]].
 *
 * @see \common\models\activequeries\ContentTopic
 */
class ContentTopicQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\activequeries\ContentTopic[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\activequeries\ContentTopic|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
