<?php

namespace backend\modules\v1\controllers;

use backend\modules\v1\models\dtos\LoginLogDto;
use backend\modules\v1\models\dtos\ResponseDto;
use backend\modules\v1\models\Persona;

// use yii\web\BadRequestHttpException;
// use yii\helpers\ArrayHelper;
use Dersonsena\JWTTools\JWTSignatureBehavior;
use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\models\UserVisitLog;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\Response;

class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [ //TODO: put in a trait
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Allow-Origin' => ['*'],
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

    public function  actionGetOwnLoginLogs(){
        $currentUser = Yii::$app->user;
        if($currentUser && Yii::$app->request->isPost){
            $logs = UserVisitLog::find()->where(['user_id'=>$currentUser->id])
                ->limit(5)->orderBy(['visit_time'=>SORT_ASC])->all();

            foreach ($logs as &$log){
                $log =(new LoginLogDto($log))->getVisitLog();
            }
            return ResponseDto::format(200, 'Success',$logs);
        }
        return ResponseDto::format(500, 'No user in session',null);
    }


}