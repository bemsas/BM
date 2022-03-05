<?php

use yii\db\Migration;

/**
 * Class m220305_050052_add_full_deck_and_pdf_to_cell_table
 */
class m220305_050052_add_full_deck_and_pdf_to_cell_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%cell}}', 'link_full_deck', $this->string(500)->null()->comment('link to Full deck'));
        $this->addColumn('{{%cell}}', 'link_pdf', $this->string(500)->null()->comment('link to Summary PDF'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {        
        $this->dropColumn('{{%cell}}', 'link_full_deck');
        $this->dropColumn('{{%cell}}', 'link_pdf');
    }    
}
