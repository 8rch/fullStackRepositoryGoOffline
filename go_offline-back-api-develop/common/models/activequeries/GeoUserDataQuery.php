<?php
namespace common\models\activequeries;

/**
 * This is the ActiveQuery class for [[GeoUserData]].
 *
 * @see GeoUserData
 */
class GeoUserDataQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return GeoUserData[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return GeoUserData|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
