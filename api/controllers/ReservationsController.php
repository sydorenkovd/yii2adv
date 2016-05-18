<?php
namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;

class ReservationsController extends ActiveController
{
    public $modelClass = 'common\models\Reservation';

     /*
    public function actionIndexWithRooms()
    {
        $reservations = \common\models\Reservation::find()->all();
        
        $outData = [];
        foreach($reservations as $r)
        {
            $outData[] = array_merge($r->attributes, ['room' => $r->room->attributes]);
        }
        return $outData;        
    } 
      */      
            
    public function actionIndexWithRooms()
    {
        $_GET['expand'] = 'room';
		
		//Yii::$app->response->fillStatusResponse(2);
		
        return $this->runAction('index');        
    }             
}
