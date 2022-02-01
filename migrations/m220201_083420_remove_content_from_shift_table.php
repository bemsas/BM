<?php

use yii\db\Migration;

/**
 * Class m220201_083420_remove_content_from_shift_table
 */
class m220201_083420_remove_content_from_shift_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%shift}}', 'question1_content');
        $this->dropColumn('{{%shift}}', 'question2_content');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%shift}}', 'question1_content', $this->string(2000)->notNull()->comment('Question 1 content'));
        $this->addColumn('{{%shift}}', 'question2_content', $this->string(2000)->notNull()->comment('Question 2 content'));            
    }    
}
