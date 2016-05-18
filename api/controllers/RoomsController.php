<?php
namespace api\controllers;

use Yii;
use yii\rest\ActiveController;

class RoomsController extends ActiveController
{
    public $modelClass = 'common\models\Room';
	
	public function behaviors()
	{
	    $behaviors = parent::behaviors();
	    $behaviors['contentNegotiator']['formats']['application/rss+xml'] = 'rss';
	    return $behaviors;
	}	
	
	public function actionIndexRss()
	{
		Yii::$app->response->format = 'rss';
		
		$provider = new \yii\data\ActiveDataProvider([
		    'query' => \common\models\Room::find(),
		    'pagination' => [
		        'pageSize' => 20,
		    ],
		]);
		
		return $provider;
	}
}
