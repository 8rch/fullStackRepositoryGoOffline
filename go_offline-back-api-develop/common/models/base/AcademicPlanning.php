<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "academic_planning".
 *
 * @property integer $id
 * @property integer $module_id
 * @property integer $career_subject_id
 * @property integer $topic_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property integer $school_year_id
 *
 * @property \common\models\CareerSubject $careerSubject
 * @property \common\models\Module $module
 * @property \common\models\SchoolYear $schoolYear
 * @property \common\models\Topic $topic
 */
class AcademicPlanning extends \yii\db\ActiveRecord
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
            'careerSubject',
            'module',
            'schoolYear',
            'topic'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_id', 'career_subject_id', 'topic_id', ], 'required'],
            [['module_id', 'career_subject_id', 'topic_id', 'created_by', 'updated_by', 'deleted_by', 'school_year_id'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'academic_planning';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'module_id' => Yii::t('app', 'Module ID'),
            'career_subject_id' => Yii::t('app', 'Career Subject ID'),
            'topic_id' => Yii::t('app', 'Topic ID'),
            'school_year_id' => Yii::t('app', 'School Year ID'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCareerSubject()
    {
        return $this->hasOne(\common\models\CareerSubject::className(), ['id' => 'career_subject_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(\common\models\Module::className(), ['id' => 'module_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchoolYear()
    {
        return $this->hasOne(\common\models\SchoolYear::className(), ['id' => 'school_year_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopic()
    {
        return $this->hasOne(\common\models\Topic::className(), ['id' => 'topic_id']);
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
     * @return \common\models\activequeries\AcademicPlanningQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \common\models\activequeries\AcademicPlanningQuery(get_called_class());
        return $query->where(['academic_planning.deleted_by' => 0]);
    }
}
