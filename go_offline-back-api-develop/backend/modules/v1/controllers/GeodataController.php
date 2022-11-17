<?php

namespace backend\modules\v1\controllers;

use backend\modules\v1\models\dtos\LoginLogDto;
use backend\modules\v1\models\dtos\ResponseDto;
use backend\modules\v1\models\Persona;

// use yii\web\BadRequestHttpException;
// use yii\helpers\ArrayHelper;
use common\models\GeoUserData;
use Dersonsena\JWTTools\JWTSignatureBehavior;
use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\models\UserVisitLog;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\Response;

class GeodataController extends ActiveController
{
    public  $modelClass = 'common\models\GeoUserData';

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
        ];

        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            //  'except' => ['login', 'options'] // it's doesn't run in login action
        ];

        return $behaviors;

    }

    public function actionSavegeo()
    {
        $model = new GeoUserData();
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->save()) {
            return ResponseDto::format(200, 'Success', Yii::$app->request->post());
        }
        return ResponseDto::format(401, 'Error saving geo data', $model->getErrors());
    }
}