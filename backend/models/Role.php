<?php

namespace backend\models;

use Yii;

/**
 * .
 *
 * 
 * @property string $item_name
 * @property string $user_id
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
       
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
       
    }
}
