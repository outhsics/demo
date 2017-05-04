<?php
namespace app\controllers;


use app\m\ModelFactory;
use app\m\News;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

use yii\rest\ActiveController;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\auth\HttpBasicAuth;
class UserController extends  BaseController
{
    public $modelClass = 'app\m\Users';

    public function behaviors()
    {
       $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];

        return $behaviors;
    }

   public function init(){

       parent::init();
       \Yii::$app->user->enableSession = false;
        $this->enableCsrfValidation = false;
    }

    public function actionUnlog()
    {
        //用户注销
        $token=\Yii::$app->request->get("access-token");
        $clients=ModelFactory::loadModel("clients")->findOne(["client_token"=>$token]);
        if($clients)
        {
            $clients->client_token=""; //把用户 token清空
            if($clients->save())
            {
                return ['status'=>"success"];
            }
        }

            return ['status'=>"error"];


    }


}