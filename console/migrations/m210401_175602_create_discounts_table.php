<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%discounts}}`.
 */
class m210401_175602_create_discounts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%discounts}}', [
            'id' => $this->primaryKey(),
            'name'=> $this->string()->notNull(),
            'description'=>$this->text()->notNull(),   
            'percent'=>$this->float()->notNull(),        
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%discounts}}');
    }
}
