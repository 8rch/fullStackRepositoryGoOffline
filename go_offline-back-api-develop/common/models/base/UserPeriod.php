<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "{{%user_period}}".
 *
 * @property integer $id
 * @property string $first_partial_note
 * @property string $second_partial_note
 * @property integer $user_id
 * @property integer $period_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property integer $pensum_id
 *
 * @property \common\models\Pensum $pensum
 * @property \common\models\Period $period
 * @property \common\models\User $user
 */
class UserPeriod extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    private $_rt_softdelete;
    private $_rt_softrestore;

    public function __construct(){
        parent::__construct();
        $this->_rt_softdelete = [
            'deleted_by' => \Yii::$app->user->id,
            'deleted_at' => date('Y-m-d H:i:s'),
        ];
        $this->_rt_softrestore = [
            'deleted_by' => 0,
            'deleted_at' => date('Y-m-d H:i:s'),
        ];
    }

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'pensum',
            'period',
            'user'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_partial_note', 'second_partial_note'], 'number'],
            [['user_id', 'period_id', 'pensum_id'], 'required'],
            [['user_id', 'period_id', 'created_by', 'updated_by', 'deleted_by', 'pensum_id'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_period}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'first_partial_note' => Yii::t('app', 'First Partial Note'),
            'second_partial_note' => Yii::t('app', 'Second Partial Note'),
            'user_id' => Yii::t('app', 'User ID'),
            'period_id' => Yii::t('app', 'Period ID'),
            'pensum_id' => Yii::t('app', 'Pensum ID'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPensum()
    {
        return $this->hasOne(\common\models\Pensum::className(), ['id' => 'pensum_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriod()
    {
        return $this->hasOne(\common\models\Period::className(), ['id' => 'period_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInactivesPeriod()
    {
     //  var_dump($this->hasOne(\common\models\Period::className(), ['id' => 'period_id'])->onlyInActive());die();
        return $this->hasOne(\common\models\Period::className(), ['id' => 'period_id'])->onlyInActive();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAllsPeriod()
    {
        return $this->hasOne(\common\models\Period::className(), ['id' => 'period_id'])->activeInactive();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'user_id']);
    }
    
    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * The following code shows how to apply a default condition for all queries:
     *
     * ```php
     * class Customer extends ActiveRecord
     * {
     *     public static function find()
     *     {
     *         return parent::find()->where(['deleted' => false]);
     *     }
     * }
     *
     * // Use andWhere()/orWhere() to apply the default condition
     * // SELECT FROM customer WHERE `deleted`=:deleted AND age>30
     * $customers = Customer::find()->andWhere('age>30')->all();
     *
     * // Use where() to ignore the default condition
     * // SELECT FROM customer WHERE age>30
     * $customers = Customer::find()->where('age>30')->all();
     * ```
     */

    /**
     * @inheritdoc
     * @return \common\models\activequeries\UserPeriodQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \common\models\activequeries\UserPeriodQuery(get_called_class());
        return $query->where(['user_period.deleted_by' => 0]);
    }

    /**
     * @inheritdoc
     * @return \common\models\activequeries\UserPeriodQuery the active query used by this AR class.
     */
    public static function findInactive()
    {
        $query = new \common\models\activequeries\UserPeriodQuery(get_called_class());
        return $query->onlyInActive();
    }

    /**
     * @inheritdoc
     * @return \common\models\activequeries\UserPeriodQuery the active query used by this AR class.
     */
    public static function findActiveInactive()
    {
        $query = new \common\models\activequeries\UserPeriodQuery(get_called_class());
        return $query->activeInactive();
    }
}
