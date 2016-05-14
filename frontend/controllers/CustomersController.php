<?php

namespace frontend\controllers;

use yii\data\ActiveDataProvider;
use common\models\Customer;

class CustomersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
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
