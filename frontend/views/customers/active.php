<?php
use yii\grid\GridView;
use yii\helpers\Html;
?>

<h2>Customers</h2>
<?= GridView::widget([
    'dataProvider' => $data,
    'columns' => [
        'id',
        'name',
        'surname',
        'phone_number'
    ],
]) ?>
