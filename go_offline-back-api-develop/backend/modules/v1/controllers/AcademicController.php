<?php

namespace backend\modules\v1\controllers;

use backend\modules\v1\models\dtos\LoginLogDto;
use backend\modules\v1\models\dtos\ResponseDto;
use backend\modules\v1\models\Persona;

// use yii\web\BadRequestHttpException;
// use yii\helpers\ArrayHelper;
use common\components\Util;
use common\models\AnswerQuestionnaire;
use common\models\Params;
use common\models\UserPeriod;
use Dersonsena\JWTTools\JWTSignatureBehavior;
use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\models\UserVisitLog;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\Json;
use yii\rest\ActiveController;
use yii\web\Response;

class AcademicController extends ActiveController
{
    public $modelClass = 'common\models\Pensum';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [ //TODO: put in a trait
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['POST', 'GET', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Allow-Headers' => ['Origin', 'X-Requested-With', 'Content-Type', 'accept', 'Authorization'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Max-Age' => 3600, // Cache (seconds)
                // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                'Access-Control-Expose-Headers' => ['X-Pagination-Total-Count', 'X-Pagination-Page-Count', 'X-Pagination-Current-Page', 'X-Pagination-Per-Page']
            ]
        ];
        $behaviors['contentNegotiator'] = [
            'class' => 'yii\filters\ContentNegotiator',
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        $behaviors['jwtValidator'] = [
            'class' => JWTSignatureBehavior::class,
            'secretKey' => Yii::$app->params['jwt']['secret'],
            'except' => ['login'] // it's doesn't run in login action
        ];

        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            //  'except' => ['login', 'options'] // it's doesn't run in login action
        ];

        return $behaviors;

    }

    public function actionGetUserPeriod()
    {
        $user = null;
        $user_id = (Yii::$app->request->post())['user_id'];

        if (Yii::$app->request->isPost) {
            $user = (new \common\models\User())->findIdentity($user_id);
        }
        if ($user) {
            $model = (new UserPeriod())->find()
                ->where(['user_id' => $user->id])
                ->onlyActive()
                ->one();

            if ($model) {
                return ResponseDto::format(200, 'Success', $model);
            }
        }
        return ResponseDto::format(400, 'No data', null);
    }

    // el estudiante debe de tener unicament un periodo
    // con cada nuevo registro de periodo, el antiguo se da de baja
    public function actionGetPensumAssigned()
    {
        $period_id = (Yii::$app->request->post())['period_id'];
        $user_id = Yii::$app->user->id;
        if (!$period_id && $user_id) {
            return ResponseDto::format(500, 'Period id is missing', null);
        }
        $models = Yii::$app->Util->getResulPensumAsigned($period_id, $user_id, false, '');

        if ($models) {
            return ResponseDto::format(200, 'Success', $models);
        }
        return ResponseDto::format(400, 'No data', null);

    }

    public function actionGetTopics()
    {
        $topic_id = (Yii::$app->request->post())['topic_id'];
        $user_id = (Yii::$app->request->post())['user_id'];
        if (!$topic_id) {
            return ResponseDto::format(500, 'Topic id is missing', null);
        }
        $models = Yii::$app->db
            ->createCommand(' select * from function_get_topic_filtered(:topic_id::int4, :user_id::int4) ')
            ->bindValue(':topic_id', $topic_id)
            ->bindValue(':user_id', $user_id)
            ->queryAll();
        if ($models) {
            return ResponseDto::format(200, 'Success', $models);
        }
        return ResponseDto::format(400, 'No data', null);
    }

    public function actionGetQuestionaire()
    {
        $topic_id = (Yii::$app->request->post())['topic_id'];
        $user_id = (Yii::$app->request->post())['user_id'];
        if (!$topic_id) {
            return ResponseDto::format(500, 'Topic id is missing', null);
        }
        $models = Yii::$app->db
            ->createCommand('
           select * from function_get_questionnaire_filtered(:id,:userId);')
            ->bindValue(':id', $topic_id)
            ->bindValue(':userId', $user_id)
            ->queryAll();
        if ($models) {
            return ResponseDto::format(200, 'Success', $models);
        }
        return ResponseDto::format(400, 'No data', null);
    }

    public function actionPostAnswer()
    {
        $request = Yii::$app->request;

        if ($request->isPost) {
            $questionnaire_id = $request->post()['questionnaire_id'];
            $answers_user = $request->post()['answers_user'];
            $user_id = $request->post()['user_id'];
            $answers_correct = $request->post()['answers_correct'];
            $attempt = $request->post()['attempt'];
        }

        if (!isset($answers_user) &&
            !($answers_user['evaluation'] == "" || $answers_user['reinforcement_evaluation'] == "")) {
            return ResponseDto::format(400, 'Data insuficiente falta evaluacion o refuerzo', null);
        }

        //  questionnaire_id', 'user_id', 'answers_user', 'answer_correct', 'answer_incorrect'
        $model = new AnswerQuestionnaire();
        $model->user_id = $user_id;
        $model->questionnaire_id = $questionnaire_id;
        $model->answers_user = Json::encode($answers_user);
        $model->answer_correct = Json::encode($answers_correct);
        $model->evaluation_is_correct = false;
        $model->reinforcement_evaluation_is_correct = false;
        $model->attempt = $attempt;

        $max_attempt = Params::find()->where(['name' => 'max_answer_attempts'])->one();
        $max_attempt = $max_attempt->value;

        if (!$attempt > $max_attempt) {
            return ResponseDto::format(400, 'Maximo de intentos permitidos', null);
        }
        if ($answers_correct['evaluation'][$answers_user['evaluation']] == 1) {
            $model->evaluation_is_correct = true;
        }
        if (($answers_user['reinforcement_evaluation']) != '' && $answers_correct['reinforcement_evaluation'][$answers_user['reinforcement_evaluation']] == 1) {
            $model->reinforcement_evaluation_is_correct = true;
        }

        if ($model->save()) {
            return ResponseDto::format(200, 'Success', [
                'evaluation' => $model->evaluation_is_correct,
                'reinforcement_evaluation' => $model->reinforcement_evaluation_is_correct,
            ]);
        } else {
            return ResponseDto::format(400, 'Error', $model->getErrors());
        }
        return ResponseDto::format(400, 'Data insuficiente', null);
    }

    public function actionGetPensumAssignedByDay()
    {
        $period_id = (Yii::$app->request->post())['period_id'];
        $refDate = (Yii::$app->request->post())['ref_date'];
        $user_id = Yii::$app->user->id;
        if (!$period_id && $user_id) {
            return ResponseDto::format(500, 'Period id is missing', null);
        }
        $models = Yii::$app->Util->getResulPensumAsigned($period_id, $user_id, true, $refDate);
        if ($models) {
            return ResponseDto::format(200, 'Success', $models);
        }
        return ResponseDto::format(400, 'No data', null);
    }
}