<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m220130_061903_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey()->comment('ID'),
            'email' => $this->string(200)->unique()->notNull()->comment('Email'),
            'name' => $this->string(200)->notNull()->comment('Name'),
            'password_hash' => $this->string(200)->notNull()->comment('Password hash'),
            'type' => $this->smallInteger()->notNull()->defaultValue(3)->comment('Access type'),
            'company_id' => $this->integer()->notNull()->comment('company ID'),
        ]);
        
        $this->addForeignKey('fk_user_company_id', '{{%user}}', 'company_id', 'company', 'id', 'cascade', 'cascade');
        $this->createIndex('idx_user_company_id', '{{%user}}', 'company_id');
        
        $this->insert('{{%user}}', [
            'email' => 'admin@belief-map.com',
            'name' => 'Administrator',
            'password_hash' => \Yii::$app->security->generatePasswordHash('Fg4!_cZ9'),
            'type' => 1,
            'company_id' => 1
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
