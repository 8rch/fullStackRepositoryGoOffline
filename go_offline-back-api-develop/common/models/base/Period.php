<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "{{%period}}".
 *
 * @property integer $id
 * @property string $init_date
 * @property string $end_date
 * @property string $end_date_to_deadline
 * @property string $end_date_exam_score_deadline
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \common\models\UserPeriod[] $userPeriods
 */
class Period extends \yii\db\ActiveRecord
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
            'userPeriods'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['init_date', 'end_date', 'end_date_to_deadline', 'end_date_exam_score_deadline'], 'required'],
            [['init_date', 'end_date', 'end_date_to_deadline', 'end_date_exam_score_deadline', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%period}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'init_date' => Yii::t('app', 'Init Date'),
            'end_date' => Yii::t('app', 'End Date'),
            'end_date_to_deadline' => Yii::t('app', 'End Date To Deadline'),
            'end_date_exam_score_deadline' => Yii::t('app', 'End Date Exam Score Deadline'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPeriods()
    {
        return $this->hasMany(\common\models\UserPeriod::className(), ['period_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPeriodsActiveInactives()
    {
        return $this->hasMany(\common\models\UserPeriod::className(), ['period_id' => 'id'])->activeInactive();
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
     * @return \common\models\activequeries\PeriodQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \common\models\activequeries\PeriodQuery(get_called_class());
        return $query->where(['period.deleted_by' => 0]);
    }

    public static function findActiveInactive()
    {
        $query = new \common\models\activequeries\PeriodQuery(get_called_class());
        return $query;
    }
}
