<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%map}}`.
 */
class m220113_063605_create_map_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%map}}', [
            'id' => $this->primaryKey()->comment('ID'),
            'name' => $this->string(200)->notNull()->comment('Name'),
            'question1_text' => $this->string(200)->notNull()->comment('Question 1'),
            'question2_text' => $this->string(200)->notNull()->comment('Question 2'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%map}}');
    }
}
