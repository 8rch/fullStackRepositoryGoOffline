<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "{{%answer_questionnaire}}".
 *
 * @property integer $id
 * @property integer $questionnaire_id
 * @property integer $user_id
 * @property array $answers_user
 * @property array $answer_correct
 * @property boolean $evaluation_is_correct
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property boolean $reinforcement_evaluation_is_correct
 * @property integer $attempt

 *
 * @property \common\models\Questionnaire $questionnaire
 * @property \common\models\User $user
 */
class AnswerQuestionnaire extends \yii\db\ActiveRecord
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
            'questionnaire',
            'user'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['questionnaire_id', 'user_id', 'answers_user', 'answer_correct',], 'required'],
            [['questionnaire_id', 'user_id', 'created_by', 'updated_by', 'deleted_by','attempt'], 'integer'],
            [['answers_user', 'answer_correct'], 'string'],
            [['evaluation_is_correct', 'reinforcement_evaluation_is_correct'], 'boolean'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%answer_questionnaire}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'questionnaire_id' => Yii::t('app', 'Questionnaire ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'answers_user' => Yii::t('app', 'Answers User'),
            'answer_correct' => Yii::t('app', 'Answer Correct'),
            'evaluation_is_correct' => Yii::t('app', 'Evaluation Is Correct'),
            'reinforcement_evaluation_is_correct' => Yii::t('app', 'Reinforcement Evaluation Is Correct'),
            'attempt' => Yii::t('app', 'Attempt'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionnaire()
    {
        return $this->hasOne(\common\models\Questionnaire::className(), ['id' => 'questionnaire_id']);
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
     * @return \common\models\activequeries\AnswerQuestionnaireQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \common\models\activequeries\AnswerQuestionnaireQuery(get_called_class());
        return $query->where(['answer_questionnaire.deleted_by' => 0]);
    }
}
