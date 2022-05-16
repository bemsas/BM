<?php

use yii\db\Migration;

/**
 * Class m220516_173534_add_hello_to_company_table
 */
class m220516_173534_add_hello_to_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $defaultLeft = "The disease is most common in the elderly, with the highest proportion of costs attributed to hospitalisations<br>
            <br>
            * The disease affects approximately 8% of the adult population in Europe 1<br>
            * It affects as many as 6 % of people > 60 years of age 1<br>
            <br>
            Patients with the disease had a decreased adjusted HRQoL score of 4.7, reflecting a poorer. European guidelines recommend screening for patients with the disease.<br>
            <br>
            The European guidelines state ‘’ diagnostics tests should be used for initial assessment of a patient with newly diagnosed disease in order to evaluate their suitability for particular therapies’.";
        $defaultRight = "Patients with the disease had a decreased adjusted HRQoL score of 4.7, reflecting a poorer. European guidelines recommend screening for patients with the disease.<br>
            <br>
            The European guidelines state ‘’ diagnostics tests should be used for initial assessment of a patient with newly diagnosed disease in order to evaluate their suitability for particular therapies’.<br>
            <br>
            The limitations of current therapies<br>
            <br>
            Current therapies are associated with substantial toxicity, which contributes to morbidity and mortality<br>
            <br>
            Current therapies are associated with substantial toxicity, due to non-specific effects, causing adverse events.";
        $this->addColumn('{{%company}}', 'hello_left', $this->text()->null()->defaultValue($defaultLeft));
        $this->addColumn('{{%company}}', 'hello_right', $this->text()->null()->defaultValue($defaultRight));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%company}}', 'hello_left');
        $this->dropColumn('{{%company}}', 'hello_right');
    }    
}
