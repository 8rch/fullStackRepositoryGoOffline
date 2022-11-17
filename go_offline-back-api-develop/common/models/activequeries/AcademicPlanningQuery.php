<?php

namespace common\models\activequeries;

/**
 * This is the ActiveQuery class for [[\common\models\activequeries\AcademicPlanning]].
 *
 * @see \common\models\activequeries\AcademicPlanning
 */
class AcademicPlanningQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\activequeries\AcademicPlanning[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\activequeries\AcademicPlanning|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
