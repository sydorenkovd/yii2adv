<?php

namespace frontend\controllers;

use common\models\Reservation;
use yii\data\ActiveDataProvider;
use common\models\ReservationSearch;
use common\models\Room;
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
    public function actionMultiplegrid()
    {
        /**
         * Reservations
         */
        $reservationsQuery = Reservation::find();
        $reservationsSearchModel = new ReservationSearch();

        if(isset($_GET['ReservationSearch']))
        {
            $reservationsSearchModel->load( Yii::$app->request->get() );

            $reservationsQuery->joinWith(['customer']);
            $reservationsQuery->andFilterWhere(
                ['LIKE', 'customer.surname', $reservationsSearchModel->getAttribute('customer.surname')]
            );

            $reservationsQuery->andFilterWhere([
                'id' => $reservationsSearchModel->id,
                'customer_id' => $reservationsSearchModel->customer_id,
                'room_id' => $reservationsSearchModel->room_id,
                'price_per_day' => $reservationsSearchModel->price_per_day,

            ]);
        }

        $reservationsDataProvider = new ActiveDataProvider([
            'query' => $reservationsQuery,
            'sort' => [
                'sortParam' => 'reservations-sort-param',
            ],
            'pagination' => [
                'pageSize' => 10,
                'pageParam' => 'reservations-page-param'
            ],
        ]);


        /**
         * Rooms
         */
        $roomsQuery = Room::find();
        $roomsSearchModel = new Room();

        if(isset($_GET['Room']))
        {
            $roomsSearchModel->load( Yii::$app->request->get() );

            $roomsQuery->andFilterWhere([
                'id' => $roomsSearchModel->id,
                'floor' => $roomsSearchModel->floor,
                'room_number' => $roomsSearchModel->room_number,
                'has_conditioner' => $roomsSearchModel->has_conditioner,
                'has_phone' => $roomsSearchModel->has_conditioner,
                'has_tv' => $roomsSearchModel->has_conditioner,
                'available_from' => $roomsSearchModel->has_conditioner,

            ]);
        }


        $roomsDataProvider = new ActiveDataProvider([
            'query' => $roomsQuery,
            'sort' => [
                'sortParam' => 'rooms-sort-param',
            ],
            'pagination' => [
                'pageSize' => 10,
                'pageParam' => 'rooms-page-param'
            ],
        ]);

        return $this->render('multipleGrid', [
            'reservationsDataProvider' => $reservationsDataProvider, 'reservationsSearchModel' => $reservationsSearchModel,
            'roomsDataProvider' => $roomsDataProvider, 'roomsSearchModel' => $roomsSearchModel,
        ]);

    }
    public function actionThreeColumns(){
        return $this->render('three-columns');
    }

}
