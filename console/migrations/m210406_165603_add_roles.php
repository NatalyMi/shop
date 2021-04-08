<?php

use yii\db\Migration;

/**
 * Class m210406_165603_add_roles
 */
class m210406_165603_add_roles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
      //  $auth->add($auth->createRole('user'));
      //  $auth->add($auth->createRole('manger'));
        $user = $auth->getRole('user');
        $auth->assign($user,2);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210406_165603_add_roles cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210406_165603_add_roles cannot be reverted.\n";

        return false;
    }
    */
}
