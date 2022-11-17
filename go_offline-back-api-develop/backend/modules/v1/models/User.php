<?php
namespace backend\modules\v1\models;

use Dersonsena\JWTTools\JWTTools;
use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    // ...
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        // we don't need to implement this method
    }

    public function validateAuthKey($authKey)
    {
        // we don't need to implement this method
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        $decodedToken = JWTTools::build(Yii::$app->params['jwt']['secret'])
            ->decodeToken($token);
        return static::findOne(['id' => $decodedToken->id]);
    }
}