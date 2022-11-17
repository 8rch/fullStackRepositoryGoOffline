<?php

namespace common\models\activequeries;

/**
 * This is the ActiveQuery class for [[\common\models\activequeries\PensumModule]].
 *
 * @see \common\models\activequeries\PensumModule
 */
class PensumModuleQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\activequeries\PensumModule[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\activequeries\PensumModule|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
