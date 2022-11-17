<?php

namespace common\models\activequeries;

/**
 * This is the ActiveQuery class for [[\common\models\activequeries\Period]].
 *
 * @see \common\models\activequeries\Period
 */
class PeriodQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\activequeries\Period[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \frontend\models\activequeries\Period|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function onlyInActive($db = null)
    {
        return parent::where(' deleted_at IS NOT NULL and deleted_by <> 0 ');
    }

    public function activeInactive($db = null)
    {
        return parent::where(' 1=1 ');
    }
}
