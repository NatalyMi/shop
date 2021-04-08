<?php
namespace common\models;

use Yii;
use \yii\db\ActiveRecord;

/** 
*
* @property int $id
* @property int $customer_id
* @property int $tovar_id
* @property int $count
* @property float $sum
*/
class Order extends ActiveRecord
{
    public static function tableName()
    {
        return 'order';
    }

    public function rules()
    {
        return [];
    }

    public function attributeLabel()
    {
        return [];
    }
}