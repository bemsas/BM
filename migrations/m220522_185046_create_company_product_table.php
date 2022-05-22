<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company_product}}`.
 */
class m220522_185046_create_company_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company_product}}', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('fk_company_product_company_id', '{{%company_product}}', 'company_id', 'company', 'id');
        $this->createIndex('idx_company_product_company_id', '{{%company_product}}', 'company_id');

        $this->addForeignKey('fk_company_product_product_id', '{{%company_product}}', 'product_id', 'product', 'id');
        $this->createIndex('idx_company_product_product_id', '{{%company_product}}', 'product_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%company_product}}');
    }
}
