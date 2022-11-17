<?php
namespace common\models;

use Yii;
use \common\models\base\GeoUserData as BaseGeoUserData;

/**
 * This is the model class for table "geo_user_data".
 */
class GeoUserData extends BaseGeoUserData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['long', 'lat', 'user_id'], 'required'],
                [['extra'], 'string'],
                [['user_id'], 'integer'],
                [['long', 'lat'], 'string', 'max' => 255],
            ]);
    }

}
