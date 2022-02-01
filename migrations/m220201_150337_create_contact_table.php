<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contact}}`.
 */
class m220201_150337_create_contact_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contact}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('user ID'),
            'name' => $this->string(200)->notNull()->comment('Name'),
            'phone' => $this->string(20)->null()->comment('Phone'),
            'email' => $this->string(200)->null()->comment('Email'),
            'comment' => $this->string(2000)->null()->comment('Comment'),
        ]);
        
        $this->addForeignKey('fk_contact_user_id', '{{%contact}}', 'user_id', '{{%user}}', 'id', 'cascade', 'cascade');
        $this->createIndex('idx_contact_user_id', '{{%contact}}', 'user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contact}}');
    }
}
