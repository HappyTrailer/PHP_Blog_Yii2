<?php
/**
 * Created by PhpStorm.
 * User: Ruslan
 * Date: 25.10.2016
 * Time: 13:32
 */

namespace app\models;


use DateTime;
use DateTimeZone;
use yii\db\ActiveRecord;

class Posts extends ActiveRecord
{
    public function rules()
    {
        return [
            [['title', 'content', 'user_id', 'created_at', 'updated_at', 'category_id', 'img_src'], 'required']
        ];
    }

    public function getCategories () {
        return self::hasOne(Categories::className(), ['id' => 'category_id']);
    }

    public function getUsers () {
        return self::hasOne(Users::className(), ['id' => 'user_id']);
    }

    public function getDateStr()
    {
        $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        $date_sec = $this->updated_at;
        $month = $months[(int)date('m', $date_sec) - 1];
        $day = date('d', $date_sec);
        $year = date('Y', $date_sec);
        $time = new DateTime("@$date_sec");
        $time->setTimezone(new DateTimeZone('Europe/Kiev'));
        return $month . " " . $day . ", " . $year . " - " . $time->format('H:i');
    }
}