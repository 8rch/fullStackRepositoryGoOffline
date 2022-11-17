<?php

namespace common\models\activequeries;

/**
 * This is the ActiveQuery class for [[\common\models\activequeries\CareerSubject]].
 *
 * @see \common\models\activequeries\CareerSubject
 */
class CareerSubjectQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\activequeries\CareerSubject[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\activequeries\CareerSubject|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
