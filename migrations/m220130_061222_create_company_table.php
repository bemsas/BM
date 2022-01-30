<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company}}`.
 */
class m220130_061222_create_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company}}', [
            'id' => $this->primaryKey()->comment('ID'),
            'name' => $this->string(200)->notNull()->comment('Name'),
        ]);
        
        $this->insert('{{%company}}', ['name' => 'Administrators']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%company}}');
    }
}
