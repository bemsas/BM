<?php

use yii\db\Migration;

/**
 * Class m220428_074257_add_last_login_to_user_table
 */
class m220428_074257_add_last_login_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'last_login', $this->dateTime()->null()->comment('Last user login'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'last_login');
    }
    
}
