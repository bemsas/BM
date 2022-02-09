<?php

use yii\db\Migration;

/**
 * Class m220209_044116_add_content_to_cell_table
 */
class m220209_044116_add_content_to_cell_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%cell}}', 'question1_compact', $this->string(200)->notNull()->defaultValue('question 1 compact content')->comment('Question 1 content'));
        $this->addColumn('{{%cell}}', 'question2_compact', $this->string(200)->notNull()->defaultValue('question 2 compact content')->comment('Question 2 content'));
        $this->addColumn('{{%cell}}', 'content', $this->string(4000)->notNull()->defaultValue('shift full content')->comment('content'));
        $this->addColumn('{{%cell}}', 'links', $this->string(4000)->null()->comment('links'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {        
        $this->dropColumn('{{%cell}}', 'question1_compact');
        $this->dropColumn('{{%cell}}', 'question2_compact');
        $this->dropColumn('{{%cell}}', 'content');
        $this->dropColumn('{{%cell}}', 'links');
    }    
}
