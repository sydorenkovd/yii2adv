<?php
namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;

class UsersController extends ActiveController
{
    public $modelClass = 'common\models\User';
    
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
                'except' => ['login'],
                'class' => \api\components\SessionAuth::className(),
        ];
        
        return $behaviors;
    }    

    public function actionLogin($username, $passwordHash)
    {
        $dataOut = null;
        
        $user = \common\models\User::findOne(['username' => $username, 'password_hash' => $passwordHash]);
        if($user != null)
        {
            $session = Yii::$app->session;
            $session->open();
            
            $session['loggedUser'] = $user;
            
            $sid = $session->id;
            
            $dataOut = ['sid' => $sid];        
        }
        
        return $dataOut;
    }
}
