<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "{{%questionnaire}}".
 *
 * @property integer $id
 * @property integer $topic_id
 * @property string $type
 * @property string $content
 * @property array $questions
 * @property array $answers
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $dead_line

 * @property \common\models\AnswerQuestionnaire[] $answerQuestionnaires
 * @property \common\models\Topic $topic
 */
class Questionnaire extends \yii\db\ActiveRecord
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
            'answerQuestionnaires',
            'topic'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['topic_id', 'type', 'questions', 'answers'], 'required'],
            [['topic_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['questions', 'answers', 'code'], 'string'],
            [['created_at', 'updated_at', 'deleted_at', 'dead_line'], 'safe'],
            [['type'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%questionnaire}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'topic_id' => Yii::t('app', 'Topic ID'),
            'type' => Yii::t('app', 'Type'),
            'questions' => Yii::t('app', 'Questions'),
            'answers' => Yii::t('app', 'Answers'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswerQuestionnaires()
    {
        return $this->hasMany(\common\models\AnswerQuestionnaire::className(), ['questionnaire_id' => 'id']);
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
     * @return \common\models\activequeries\QuestionnaireQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \common\models\activequeries\QuestionnaireQuery(get_called_class());
        return $query->where(['questionnaire.deleted_by' => 0]);
    }
}
