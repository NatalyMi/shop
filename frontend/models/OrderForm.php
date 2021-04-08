<?php

namespace frontend\models;

use yii\base\Model;

class OrderForm extends Model
{
    public $count;
    public $customer_id;
    public $sum;
    public $tovar_id;

    public function rules()
    {
        return[
           
            [['count'], 'integer', 'min' => 1],
            [['sum'], 'double', 'min' => 0],
          
        ];     
    }
    public function attributeLabels()
    {
        return [
           
        ];
    }
    public function upload()
    {
        
    }
}
