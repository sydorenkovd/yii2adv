<?php

namespace frontend\controllers;

use yii\data\ActiveDataProvider;
use common\models\Customer;

class CustomersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = Customer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [ 'dataProvider' => $dataProvider ]);
    }
    public function actionActive(){
        $data = new ActiveDataProvider([
            'query' => Customer::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('active', ['data' => $data]);
    }

}
