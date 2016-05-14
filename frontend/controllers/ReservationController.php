<?php

namespace frontend\controllers;

use common\models\Reservation;
use yii\data\ActiveDataProvider;

class ReservationController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = Reservation::find();
        if(isset($_GET['Reservation'])){
            $query->andFilterWhere([
               'customer_id' => $_GET['Reservation']['customer_id'] ? $_GET['Reservation']['customer_id'] : null,
            ]);
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 10,
                ]
            ]);
        }
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

}
