<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shift}}`.
 */
class m220113_063815_create_shift_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shift}}', [
            'id' => $this->primaryKey(),
            'cell_start_id' => $this->integer()->notNull()->comment('start cell ID'),
            'cell_end_id' => $this->integer()->notNull()->comment('end cell ID'),
            'question1_content' => $this->string(2000)->notNull()->comment('Question 1 content'),
            'question2_content' => $this->string(2000)->notNull()->comment('Question 2 content'),
        ]);
        
        $this->addForeignKey('fk_shift_cell_start_id', '{{%shift}}', 'cell_start_id', 'cell', 'id', 'cascade', 'cascade');
        $this->createIndex('idx_shift_cell_start_id', '{{%shift}}', 'cell_start_id');
        
        $this->addForeignKey('fk_shift_cell_end_id', '{{%shift}}', 'cell_end_id', 'cell', 'id', 'cascade', 'cascade');
        $this->createIndex('idx_shift_cell_end_id', '{{%shift}}', 'cell_end_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shift}}');
    }
}
