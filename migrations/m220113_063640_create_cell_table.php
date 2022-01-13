<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cell}}`.
 */
class m220113_063640_create_cell_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cell}}', [
            'id' => $this->primaryKey(),
            'answer1_id' => $this->integer()->notNull()->comment('first answer ID'),
            'answer2_id' => $this->integer()->notNull()->comment('second answer ID'),
        ]);
        $this->addForeignKey('fk_cell_answer1_id', '{{%cell}}', 'answer1_id', 'answer', 'id', 'cascade', 'cascade');
        $this->createIndex('idx_cell_answer1_id', '{{%cell}}', 'answer1_id');
        
        $this->addForeignKey('fk_cell_answer2_id', '{{%cell}}', 'answer2_id', 'answer', 'id', 'cascade', 'cascade');
        $this->createIndex('idx_cell_answer2_id', '{{%cell}}', 'answer2_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cell}}');
    }
}
