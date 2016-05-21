<?php
namespace frontend\controllers;

use Yii;
use GuzzleHttp\Client; // подключаем Guzzle
use yii\helpers\Url;

class YandexController extends \yii\web\Controller
{
    public function actionYandex()
    {

// создаем экземпляр класса
        $client = new Client();
// отправляем запрос к странице Яндекса
        $res = $client->request('GET', 'http://www.yandex.ru');
// получаем данные между открывающим и закрывающим тегами body
        $document = $res->getBody();
// вывод страницы Яндекса в представление
        return $this->render('yandex', ['document' => $document]);
    }
}