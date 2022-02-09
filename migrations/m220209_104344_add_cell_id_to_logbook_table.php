<?php

use yii\db\Migration;

/**
 * Class m220209_104344_add_cell_id_to_logbook_table
 */
class m220209_104344_add_cell_id_to_logbook_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->truncateTable('logbook');
        $this->addColumn('logbook', 'cell_id', $this->integer()->notNull()->comment('cell ID'));
        
        $this->addForeignKey('fk_logbook_cell_id', '{{%logbook}}', 'cell_id', 'cell', 'id', 'cascade', 'cascade');
        $this->createIndex('idx_logbook_cell_id', '{{%logbook}}', 'cell_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('logbook', 'cell_id');
    }    
}
