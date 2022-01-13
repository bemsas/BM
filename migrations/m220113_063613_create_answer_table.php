<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%answer}}`.
 */
class m220113_063613_create_answer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%answer}}', [
            'id' => $this->primaryKey()->comment('ID'),
            'map_id' => $this->integer()->notNull()->comment('map ID'),
            'content' => $this->string(500)->notNull()->comment('Content'),
            'question' => $this->smallInteger()->notNull()->defaultValue(1)->comment('Question 1/2')
        ]);
        
        $this->addForeignKey('fk_answer_map_id', '{{%answer}}', 'map_id', 'map', 'id', 'cascade', 'cascade');
        $this->createIndex('idx_answer_map_id', '{{%answer}}', 'map_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%answer}}');
    }
}
