<?php

namespace common\models\activequeries;

/**
 * This is the ActiveQuery class for [[\common\models\activequeries\UserPeriod]].
 *
 * @see \common\models\activequeries\UserPeriod
 */
class UserPeriodQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\activequeries\UserPeriod[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\activequeries\UserPeriod|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function onlyActive($db = null): UserPeriodQuery
    {
        return parent::andWhere(['user_period.deleted_at'=>null,'user_period.deleted_by'=>0,]);
    }

    public function onlyInActive($db = null): UserPeriodQuery
    {
        return parent::andWhere(' user_period.deleted_at IS NOT NULL AND user_period.deleted_by <> 0 ');
    }

    public function activeInactive($db = null): UserPeriodQuery
    {
        return parent::orWhere(' 1=1 ');
    }
}
