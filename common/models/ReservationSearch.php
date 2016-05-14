<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reservation".
 *
 * @property integer $id
 * @property integer $room_id
 * @property integer $customer_id
 * @property string $price_per_day
 * @property string $date_from
 * @property string $date_to
 * @property string $reservation_date
 *
 * @property Room $room
 * @property Customer $customer
 */
class ReservationSearch extends Reservation
{
    public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), ['customer.surname']);
    }

    public function rules()
    {
        // add related rules to searchable attributes
        return array_merge(parent::rules(),[ ['customer.surname', 'safe'] ]);
    }

}