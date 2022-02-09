<?php

use yii\db\Migration;

/**
 * Class m220209_123626_add_intro_to_map_table
 */
class m220209_123626_add_intro_to_map_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%map}}', 'intro', $this->string(2000)->null()->defaultValue('map intro content')->comment('Intro content'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%map}}', 'intro');
    }
    
}
