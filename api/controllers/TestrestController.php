<?php
namespace api\controllers;

use yii\rest\Controller;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\auth\HttpBearerAuth;

class TestRestController extends Controller
{
    private function dataList()
    {
        return [
            [ 'id' => 1, 'name' => 'Albert', 'surname' => 'Einstein' ],
            [ 'id' => 2, 'name' => 'Enzo', 'surname' => 'Ferrari' ],
            [ 'id' => 4, 'name' => 'Mario', 'surname' => 'Bros' ]
        ];
    }



    public function actionIndex()
    {
        return $this->dataList();
    }



    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class' => \yii\filters\VerbFilter::className(),
            'actions' => [
                'index'  => ['get'],
            ],
        ];

        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];

        return $behaviors;
    }

    public static function httpBasicAuthHandler1($username, $password)
    {
        $user = \common\models\User::findOne(1);
        return $user;
    }
}