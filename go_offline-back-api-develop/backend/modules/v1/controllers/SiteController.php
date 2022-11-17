<?php

namespace backend\modules\v1\controllers;

use backend\modules\v1\models\dtos\ResponseDto;
use backend\modules\v1\models\dtos\UserDto;
use common\models\Params;
use DateInterval;
use DateTime;
use Dersonsena\JWTTools\JWTSignatureBehavior;
use Dersonsena\JWTTools\JWTTools;
use webvimark\modules\UserManagement\models\User;
use Yii;
use yii\db\ActiveRecord;
use yii\filters\auth\HttpBearerAuth;
use yii\rbac\Role;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
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
            'except' => ['login', 'options'] // it's doesn't run in login action
        ];

        return $behaviors;
    }

    public function actionLogin(): array
    {
        $model = new LoginForm();
        if (Yii::$app->request->isAjax) {
            return ResponseDto::format(401, 'Failed Login', null);
        }

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $now =  new DateTime();
            $token = JWTTools::build(Yii::$app->params['jwt']['secret'],[
                'expiration'=> $now->add(new DateInterval("P1D"))->getTimestamp(),
            ])
                ->withModel(\Yii::$app->user->getIdentity(), ['username', 'email', 'id']);
            $roles = \Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);

            $tempModel = new \webvimark\modules\UserManagement\models\rbacDB\Role();
            if (count($roles) > 0) {
                $rol = array_pop($roles);
                $tempModel->name = $rol->name;
                $tempModel->type = $rol->type;
            } else {
                $tempModel->name = 'superadmin';
                $tempModel->type = 'superadmin';
            }
            $qtyAttempt = Params::find()->where("name = 'max_answer_attempts'")->one();
            $token->withModel($tempModel,['type','name']);
            $token->withModel($qtyAttempt,['value']);

            $token = $token->getJWT();
            \webvimark\modules\UserManagement\models\UserVisitLog::newVisitor(Yii::$app->user->id);

            return ResponseDto::format(200, 'Login success',
                ['token' => $token]);
        }
        return ResponseDto::format(401, 'Failed Login', null);
    }

    public function actionGetsusers(): array
    {
        $dto = (new  UserDto(Yii::$app->user->getIdentity()))->getUser();
        return ResponseDto::format(400, 'TRUE', $dto);
    }


    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        // Yii::$app->user->logout();
        return ResponseDto::format(200, 'Logout success', ['token' => null]);
    }
}
