<?php
namespace backend\models;

use Yii;
use \yii\db\ActiveRecord;

/** 
*
* @property int $id
* @property string $username
* @property string $email
*/
class User extends ActiveRecord
{
    public static function tableName()
    {
        return 'user';
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