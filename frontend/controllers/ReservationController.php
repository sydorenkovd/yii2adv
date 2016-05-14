<?php

namespace frontend\controllers;

use common\models\Reservation;
use yii\data\ActiveDataProvider;
use common\models\ReservationSearch;
use Yii;
use yii\web\Controller;

class ReservationController extends Controller
{
    public function actionIndex()
    {
        $query = Reservation::find();

        $searchModel = new ReservationSearch();

        if(isset($_GET['ReservationSearch']))
        {
            $searchModel->load( Yii::$app->request->get() );

            $query->joinWith(['customer']);
            $query->andFilterWhere(
                ['LIKE', 'customer.surname', $searchModel->getAttribute('customer.surname')]
            );

            $query->andFilterWhere([
                'id' => $searchModel->id,
                'customer_id' => $searchModel->customer_id,
                'room_id' => $searchModel->room_id,
                'price_per_day' => $searchModel->price_per_day,

            ]);

        }
        $resultQueryAveragePricePerDay = $query->average('price_per_day');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index',
            [ 'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'resultQueryAveragePricePerDay' => $resultQueryAveragePricePerDay ]);
    }

}
