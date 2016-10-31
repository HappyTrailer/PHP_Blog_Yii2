<?php
/**
 * Created by PhpStorm.
 * User: belos
 * Date: 25.10.2016
 * Time: 20:02
 */

namespace app\models;

use yii\db\ActiveRecord;

class Users extends ActiveRecord
{
    public function relations()
    {
        return array(
            'users'=>array(self::HAS_ONE, 'users'),
        );
    }
}