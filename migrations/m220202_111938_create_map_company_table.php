<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%map_company}}`.
 */
class m220202_111938_create_map_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%map_company}}', [
            'id' => $this->primaryKey(),
            'map_id' => $this->integer()->notNull()->comment('map ID'),
            'company_id' => $this->integer()->notNull()->comment('company ID'),
        ]);
        
        $this->addForeignKey('fk_map_company_map_id', '{{%map_company}}', 'map_id', 'map', 'id', 'cascade', 'cascade');
        $this->createIndex('idx_map_company_map_id', '{{%map_company}}', 'map_id');
        
        $this->addForeignKey('fk_map_company_company_id', '{{%map_company}}', 'company_id', 'company', 'id', 'cascade', 'cascade');
        $this->createIndex('idx_map_company_company_id', '{{%map_company}}', 'company_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%map_company}}');
    }
}
