<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%logbook}}`.
 */
class m220201_150411_create_logbook_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%logbook}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('user ID'),
            'contact_id' => $this->integer()->notNull()->comment('contact ID'),
            'date_in' => $this->dateTime()->notNull()->comment('Time at'),
            'content' => $this->string(2000)->notNull()->comment('Content'),
        ]);
        
        $this->addForeignKey('fk_logbook_user_id', '{{%logbook}}', 'user_id', '{{%user}}', 'id', 'cascade', 'cascade');
        $this->createIndex('idx_logbook_user_id', '{{%logbook}}', 'user_id');
        
        $this->addForeignKey('fk_logbook_contact_id', '{{%logbook}}', 'contact_id', '{{%contact}}', 'id', 'cascade', 'cascade');
        $this->createIndex('idx_logbook_contact_id', '{{%logbook}}', 'contact_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%logbook}}');
    }
}
