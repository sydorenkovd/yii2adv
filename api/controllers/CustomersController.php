<?php
namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;

class CustomersController extends ActiveController
{
    public $modelClass = 'common\models\Customer';
    
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        
        $behaviors['authenticator'] = [
            'except' => [ 'access-token-by-user' ],
            'class' => CompositeAuth::className(),
            'authMethods' => [
                [
                    'class' => HttpBasicAuth::className(),
                    'auth' => function($username, $password)
                    {
                        $out = null;
                        $user = \common\models\User::findByUsername($username);
                        if($user!=null)
                        {
                            if($user->validatePassword($password)) $out = $user;
                        }
                        return $out;
                    }
                ],
                [
                    'class' => QueryParamAuth::className(),
                ]
            ]
        ];
      
        return $behaviors;
    }       
    
    public function actionAccessTokenByUser($username, $passwordHash)
    {
        $accessToken = null;
        
        $user = \common\models\User::findOne(['username' => $username, 'password_hash' => $passwordHash]);
        if($user!=null)
        {
            $user->access_token = Yii::$app->security->generateRandomString();
            $user->save();
            $accessToken = $user->access_token;
        }        
        return [ 'access-token' => $accessToken ];
    }
}
