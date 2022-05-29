<?php

use yii\db\Migration;

/**
 * Class m220529_062447_create_page_tables
 */
class m220529_062447_create_page_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%page}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Page name'),
            'content' => $this->text()->null()->comment('Page content')
        ]);
        $this->insert('{{%page}}', [
            'name' => 'help',
            'content' => "The disease is most common in the elderly, with the highest proportion of costs attributed to hospitalisations<br>
            <br>
            * The disease affects approximately 8% of the adult population in Europe 1<br>
            * It affects as many as 6 % of people > 60 years of age 1<br>
            <br>
            Patients with the disease had a decreased adjusted HRQoL score of 4.7, reflecting a poorer. European guidelines recommend screening for patients with the disease.<br>
            <br>
            The European guidelines state ‘’ diagnostics tests should be used for initial assessment of a patient with newly diagnosed disease in order to evaluate their suitability for particular therapies’.",
        ]);
        $this->insert('{{%page}}', [
            'name' => 'introduction',
            'content' => "Patients with the disease had a decreased adjusted HRQoL score of 4.7, reflecting a poorer. European guidelines recommend screening for patients with the disease.<br>
            <br>
            The European guidelines state ‘’ diagnostics tests should be used for initial assessment of a patient with newly diagnosed disease in order to evaluate their suitability for particular therapies’.<br>
            <br>
            The limitations of current therapies<br>
            <br>
            Current therapies are associated with substantial toxicity, which contributes to morbidity and mortality<br>
            <br>
            Current therapies are associated with substantial toxicity, due to non-specific effects, causing adverse events.",
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%page}}');
    }
    
}
