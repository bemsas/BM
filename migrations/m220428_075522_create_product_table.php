<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m220428_075522_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(200)->notNull()->comment('product name'),
            'description' => $this->text()->null()->comment('product description'),
            'map_id' => $this->integer()->notNull()->comment('map id'),
            'add_link'=> $this->string(200)->null()->comment('link to additional resource'),
        ]);

        $this->addForeignKey('fk_product_map_id', '{{%product}}', 'map_id', 'map', 'id', 'cascade', 'cascade');
        $this->createIndex('idx_product_map_id', '{{%product}}', 'map_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
